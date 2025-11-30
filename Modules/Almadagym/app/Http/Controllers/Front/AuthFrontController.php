<?php

namespace App\Modules\Almadagym\app\Http\Controllers\Front;

use App\Modules\Almadagym\app\Http\Controllers\Front\GenericFrontController;
use App\Modules\Almadagym\app\Models\Member;
use App\Modules\Almadagym\app\Models\MemberSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class AuthFrontController extends GenericFrontController
{
    /**
     * AuthFrontController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('guest', ['except' => ['logout', 'showProfile', 'editProfile', 'updateProfile']]);
        $this->middleware('auth', ['only' => ['editProfile', 'updateProfile']]);
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            $record = $this->mainSettings;
            $title = $record['name'];
            $lang = $this->lang;
            $record['cover_images'] = (array)$record['cover_images'];

            return view('almadagym::Front.login', compact('title', 'record', 'lang'));
        }
    }

    /**
     * Handle login request.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $user = '';
        $this->validate($request, ['phone' => 'required', 'code' => 'required']);
        $credentials = $request->only(['phone', 'code']);
        if ($credentials['code'] && $credentials['phone']) {
            $user = $this->getSubscriptionInfo($credentials['code'], $credentials['phone']);
            
            if (request()->hasSession()) {
                request()->session()->put('user', @$user->member);
            }
        }
        if (!@$user->member) {
            \Session::flash('error', trans('auth.failed'));
            return redirect()->back();
        }
        if (@$user->member) {
            return redirect()->route('showProfile');
        } else {
            \Session::flash('error', trans('auth.failed'));
            return redirect()->back();
        }
    }

    /**
     * Get subscription info from database.
     *
     * @param string $code
     * @param string $phone
     * @param string $url (deprecated, kept for compatibility)
     * @return object|null
     */
    public function getSubscriptionInfo($code, $phone, $url = 'api/member-subscription-info')
    {
        // Find member by code and phone
        $member = Member::where('code', $code)
            ->where('phone', $phone)
            ->first();

        if (!$member) {
            return null;
        }

        // Get the latest active subscription for this member
        $memberSubscription = MemberSubscription::with(['subscription'])
            ->where('member_id', $member->id)
            ->orderBy('id', 'desc')
            ->first();

        // Get subscription data
        $subscription = $memberSubscription && $memberSubscription->subscription 
            ? $memberSubscription->subscription 
            : null;

        // Set language on subscription model if it exists
        if ($subscription) {
            $subscription->lang = $this->lang;
        }

        // Combine member data with subscription info
        $memberData = $member->toArray();
        
        if ($memberSubscription && $subscription) {
            // Add subscription-related fields to member data
            // Subscription model has a name accessor that uses the lang attribute
            $memberData['subscription_name'] = $subscription->name ?? null;
            $memberData['joining_date'] = $memberSubscription->joining_date ?? null;
            $memberData['expire_date'] = $memberSubscription->expire_date ?? null;
            $memberData['amount_paid'] = $memberSubscription->amount_paid ?? 0;
            $memberData['amount_remaining'] = $memberSubscription->amount_remaining ?? 0;
            $memberData['attendees_count'] = $memberSubscription->attendees_count ?? 0;
        } else {
            // Set default values if no subscription found
            $memberData['subscription_name'] = null;
            $memberData['joining_date'] = null;
            $memberData['expire_date'] = null;
            $memberData['amount_paid'] = 0;
            $memberData['amount_remaining'] = 0;
            $memberData['attendees_count'] = 0;
        }

        // Return in the same format as the API (object with member property)
        $result = new \stdClass();
        $result->member = (object) $memberData;
        
        return $result;
    }

    /**
     * Logout the user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    /**
     * Show the profile page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showProfile()
    {
        // Refresh current_user from session to ensure we have the latest data
        if (request()->hasSession()) {
            $sessionUser = request()->session()->get('user');
            if ($sessionUser) {
                // Ensure it's an object (in case it was stored as array)
                $this->current_user = is_array($sessionUser) ? (object) $sessionUser : $sessionUser;
                View::share('currentUser', $this->current_user);
            } else {
                $this->current_user = null;
            }
        }
        
        if (!$this->current_user) {
            return redirect()->route('login');
        }
        
        return view('almadagym::Front.show_profile');
    }

    /**
     * Show the edit profile form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editProfile()
    {
        return view('almadagym::Front.edit_profile');
    }

    /**
     * Update the user profile.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        // Note: This method updates session user data, not Auth user
        // If you need to update Auth user, use User model instead
        if (!empty($this->current_user)) {
            $updated_user = $this->current_user;
            
            // Update user data from request
            if ($request->has('name')) {
                $updated_user['name'] = $request->input('name');
            }
            if ($request->has('email')) {
                $updated_user['email'] = $request->input('email');
            }
            if ($request->has('phone')) {
                $updated_user['phone'] = $request->input('phone');
            }
            
            // Update session
            if (request()->hasSession()) {
                request()->session()->put('user', $updated_user);
                request()->session()->flash('success', trans('global.profile_updated_successfully'));
            }
            return redirect()->back();
        } else {
            return $this->falseReturn('Ø§Ù„Ù…Ø³ØªØ®Ø¯Ù… ØºÙŠØ± Ù…ÙˆØ¬ÙˆØ¯', 'User Not Found');
        }
    }
}



