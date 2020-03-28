<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponser {

    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {
        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
        }

        return $this->successResponse(['data' => $collection], $code);

//        $transformer = $collection->first()->transformer;
//
//        $collection = $this->filterData($collection, $transformer);
//        $collection = $this->sortData($collection, $transformer);
//        $collection = $this->paginate($collection);
//        $collection = $this->transformData($collection, $transformer);
//        $collection = $this->cacheResponse($collection);
//
//        return $this->successResponse($collection, $code);
    }

    protected function showOne(Model $instance, $code = 200) {

        return $this->successResponse($instance, $code);
    }

    protected function showMessage($message, $code = 200)
    {
        return $this->successResponse(['data' => $message], $code);
    }


}