<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 09/10/18
 * Time: 20:03
 */

namespace Qui\lib;


class Routes
{
    /*
     * 28-10-2018 TODO 'sprint' planning
     *
     * Add careforschema uploading to view in /cms/careforschema
     * Add picture uploading to view in /cms/parents, /cms/doctors, /cms/events
     * /h
     * /h/events
     * /h/day2dayinformation
     * */
    public const routes = [
        'home' => '/',
        'about' => '/about',
        'contact' => '/contact',
        'login' => '/login',
        'logout' => '/logout',
        'register' => '/register',
        'onRegister' => '/register',
        'resetPassword' => '/resetpassword',
        'forgotPassword' => '/forgotpassword',
        // Middleware profiles_owner only
        // CMS
        // Use query parameter for day2dayinfo for which day and which kid
        // i.e ?kidId=3&id=1
        'cms' => '/cms',
        'cms_day2dayInformation' => '/cms/day2dayinformation',
        'cms_roles' => '/cms/roles',
        'cms_comments' => '/cms/comments',
        'cms_events' => '/cms/events',
        'cms_doctors' => '/cms/doctors',
        'cms_parents_caretaker' => '/cms/parent_caretaker',
        'cms_kids' => '/cms/kids',
        'cms_employees' => '/cms/employees',
        'cms_profile' => '/cms/profile',
        // Use query parameters for selecting specific kid / parent / doctor
        'cms_manage_kid' => '/cms/manage/kid', // manage child 'behandeldocument' view rights
        'cms_manage_parent' => '/cms/manage/parent_caretaker', // manage parent 'behandeldocument' view rights
        'cms_manage_doctor' => '/cms/manage/doctor', // manage with children are linked to doctor
        // Middleware superadmin role only (the only thing superadmin can do)
        'cms_users' => '/cms/users',
        'cms_careforschema' => '/cms/careforschema',
        // the 'h' is for home :). just so the uri is splitted up from the static pages
        'l_home' => '/h',
        // Middleware doctor(if child is assigned to doctor)/owner only
        // use query parameter like ?kidId=1&id=4
        // See day2dayinformation of specific child on specific day
        'day2dayinformations' => '/h/day2dayinformations',
        'day2dayinformation' => '/h/day2dayinformation',
        // maybe only certain kids/parents can see events?
        'events' => '/h/events',
        'event' => '/h/event', // <== ?id=1
        // overview of 'behandelplannen' that the doctor is assigned to (profile_owner can see all careforschemas)
        'careforschemas' => '/h/careforschemas',
        'uploadCareForSchema' => '/h/careforschemas', // <== ?id=2. upload=update
        'downloadCareForSchema' => '/h/careforschemas', // <== ?id=2

        //upload example routes
        'upload' => '/upload',
        'uploadCollection' => '/uploadcollection',
        'deleteCollection' => '/deletecollection',
        'deletePicture' => '/deletepicture',
        'updatePicture' => '/updatepicture',
        'getAllPicturesFromCollection' => '/getallpicturesfromcollection',
        'getPictureFromCollection' => '/getpicturefromcollection'
    ];
}