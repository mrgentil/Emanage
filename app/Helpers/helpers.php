<?php

use Illuminate\Support\Str;


const PAGELIST = "liste";
const PAGECREATEFORM = "create";
const PAGEEDITFORM = "edit";
const DEFAULTPASSOWRD = "password";


function userFullName()
{
    return auth()->user()->name . " " . auth()->user()->lastname;
}


function setMenuClass($route, $classe)
{
    $routeActuel = request()->route()->getName();

    if (contains($routeActuel, $route)) {
        return $classe;
    }
    return "";
}

function setMenuActive($route)
{
    $routeActuel = request()->route()->getName();

    if ($routeActuel === $route) {
        return "active";
    }
    return "";
}

function contains($container, $contenu)
{
    return Str::contains($container, $contenu);
}

function getRolesName()
{
    $rolesName = "";
    $i = 0;
    foreach (auth()->user()->roles as $role) {
        $rolesName .= $role->name;

        if ($i < sizeof(auth()->user()->roles) - 1) {
            $rolesName .= ",";
        }

        $i++;

    }

    return $rolesName;

}

/*
function setMenuClass($route, $classe){
    $routeActuel = request()->route()->getName();

    if(contains($routeActuel, $route) ){
        return $classe;
    }
    return "";
}

function setMenuActive($route){
    $routeActuel = request()->route()->getName();

    if($routeActuel === $route ){
        return "active";
    }
    return "";
}

function contains($container, $contenu){
    return Str::contains($container, $contenu);
}
