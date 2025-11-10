<?php
namespace Modules\Zonegym\Repositories;

use Modules\Zonegym\Repositories\GenericRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Modules\Zonegym\Models\District;


class DistrictRepository extends GenericRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return District::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
