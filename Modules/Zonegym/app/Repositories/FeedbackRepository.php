<?php
namespace Modules\Zonegym\Repositories;

use Modules\Zonegym\Repositories\GenericRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Modules\Zonegym\Models\Feedback;


class FeedbackRepository extends GenericRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Feedback::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
