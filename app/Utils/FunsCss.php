<?php
    function getRootCSS($name)
    {
        $route_name = \Str::upper(\Request::route()->getName());
        if(\Str::contains($route_name, \Str::upper($name))){
            echo "active open";
        }
        else
        {
            echo "";
        }
    }

    function getActiveCSS($name)
    {
        $route_name = \Str::upper(\Request::route()->getName());
        if(\Str::upper($name) == $route_name || \Str::contains($route_name, \Str::upper($name))){
            echo "active";
        }
        else
        {
            echo "";
        }
    }
    function getActiveCSSByCode($code)
    {
        $route_name = url()->current();
        if(Str::contains($route_name, $code)){
            echo "active";
        }
        else
        {
            echo "";
        }
    }
    function getActiveRoot($name)
    {
        $route_name = \Str::upper(\Request::route()->getName());
        if(\Str::upper($name) == $route_name){
            echo "active";
        }
        else
        {
            echo "";
        }
    }