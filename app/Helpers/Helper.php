<?php

namespace App\Helpers;

class Helper
{
    public static function pagination($result, $request , $limit = 10)
    {
        if ($request->has('show') && $request->input('show') === 'all') {
            $result = $result->get();
        } else {
            if ($request->has('show')) {
                $show = $request->input('show');
                $result = $result->paginate($show)->appends($request->query());
            } else {
                $result = $result->paginate($limit)->appends($request->query());
            }
        }
        return $result;
    }
}
