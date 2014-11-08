<?php
session_start();
define( 'ABSPATH', dirname(__FILE__) . '/' );
require_once(ABSPATH . 'commons/page-include.php');


// **************************************** Teacher ***************************************

////////// conference sql command
if($_GET['method'] == 'create_conference'){
    require_once(ABSPATH . 'src/function/createConference.class.php');
    $conference = new createConference();
}
else if($_GET['method'] == 'update_conference'){
    require_once(ABSPATH . 'src/function/updateConference.class.php');
    $conference = new updateConference();
}
else if($_GET['method'] == 'delete_conference'){
    require_once(ABSPATH . 'src/function/deleteConference.class.php');
    $conference = new deleteConference();
}
////////// research sql command
else if($_GET['method'] == 'create_research'){
    require_once(ABSPATH . 'src/function/createResearch.class.php');
    $research = new createResearch();

}else if($_GET['method'] == 'update_research'){
    require_once(ABSPATH . 'src/function/updateResearch.class.php');
    $research = new updateResearch();

}
else if($_GET['method'] == 'delete_research'){
    require_once(ABSPATH . 'src/function/deleteResearch.class.php');
    $research = new deleteResearch();

}
////////// advisor sql command
else if($_GET['method'] == 'create_advisor'){
    require_once(ABSPATH . 'src/function/createAdvisor.class.php');
    $advisor = new createAdvisor();

}else if($_GET['method'] == 'update_advisor'){
    require_once(ABSPATH . 'src/function/updateAdvisor.class.php');
    $advisor = new updateAdvisor();

}
else if($_GET['method'] == 'delete_advisor'){
    require_once(ABSPATH . 'src/function/deleteAdvisor.class.php');
    $advisor = new deleteAdvisor();

}

//// Time schedule
else if($_GET['method'] == 'add_schedule'){
    require_once(ABSPATH . 'src/function/add_schedule.class.php');
    $addSchedule = new AddSchedule();
    echo "<meta http-equiv=\"refresh\" content=\"0; url=". site_url ."/time_schedule.php\" />";

}

////////// TQF sql command
else if($_GET['method'] == 'create_tqf'){
    require_once(ABSPATH . 'src/function/createTQF.class.php');
    $tqf = new createTQF();
}
else if($_GET['method'] == 'update_tqf'){
    require_once(ABSPATH . 'src/function/updateTQF.class.php');
    $tqf = new updateTQF();
}
else if($_GET['method'] == 'delete_tqf'){
    require_once(ABSPATH . 'src/function/deleteTQF.class.php');
    $tqf = new deleteTQF();
}


//// profile

else if($_GET['method'] == 'update_profile'){
    require_once(ABSPATH . 'src/function/updateProfile.class.php');
    $user = new updateProfile();

}

// change password

else if($_GET['method'] == 'change_password'){
    require_once(ABSPATH . 'src/function/changePassword.class.php');
    $user = new changePassword();

}

// change update_permission

else if($_GET['method'] == 'update_permission'){
    require_once(ABSPATH . 'src/function/updatePermission.class.php');
    $permission = new updatePermission();

}
//  update_project

else if($_GET['method'] == 'user_update_project'){
    require_once(ABSPATH . 'src/function/user_updateProject.class.php');
    $project = new user_updateProject();

}




// **************************************** Admin ***************************************


////////// USER sql command
else if($_GET['method'] == 'register'){
    require_once(ABSPATH . 'src/function/register.class.php');
    $register = new RegisterAction();
}

////////// update user
else if($_GET['method'] == 'update_user'){
    require_once(ABSPATH . 'src/function/updateUser.class.php');
    $user = new UpdateUser();
}

////////// delete user
else if($_GET['method'] == 'delete_user'){
    require_once(ABSPATH . 'src/function/deleteUser.class.php');
    $user = new deleteUser();
}


// change update_permission

else if($_GET['method'] == 'update_permission'){
    require_once(ABSPATH . 'src/function/updatePermission.class.php');
    $permission = new updatePermission();
}

////////// conference
else if($_GET['method'] == 'admin_create_conference'){
    require_once(ABSPATH . 'src/function/admin_createConference.class.php');
    $conference = new admin_createConference();
}
else if($_GET['method'] == 'admin_update_conference'){
    require_once(ABSPATH . 'src/function/admin_updateConference.class.php');
    $conference = new admin_updateConference();
}
else if($_GET['method'] == 'admin_delete_conference'){
    require_once(ABSPATH . 'src/function/admin_deleteConference.class.php');
    $conference = new admin_deleteConference();
}

////////// research
else if($_GET['method'] == 'admin_create_research'){
    require_once(ABSPATH . 'src/function/admin_createResearch.class.php');
    $research = new admin_createResearch();

}else if($_GET['method'] == 'admin_update_research'){
    require_once(ABSPATH . 'src/function/admin_updateResearch.class.php');
    $research = new admin_updateResearch();

}
else if($_GET['method'] == 'admin_delete_research'){
    require_once(ABSPATH . 'src/function/admin_deleteResearch.class.php');
    $research = new admin_deleteResearch();

}

////////// advisor

else if($_GET['method'] == 'admin_create_advisor'){
    require_once(ABSPATH . 'src/function/admin_createAdvisor.class.php');
    $advisor = new admin_createAdvisor();

}else if($_GET['method'] == 'admin_update_advisor'){
    require_once(ABSPATH . 'src/function/admin_updateAdvisor.class.php');
    $advisor = new admin_updateAdvisor();

}
else if($_GET['method'] == 'admin_delete_advisor'){
    require_once(ABSPATH . 'src/function/admin_deleteAdvisor.class.php');
    $advisor = new admin_deleteAdvisor();

}

////////// TQF

else if($_GET['method'] == 'admin_create_tqf'){
    require_once(ABSPATH . 'src/function/admin_createTQF.class.php');
    $tqf = new admin_createTQF();
}
else if($_GET['method'] == 'admin_update_tqf'){
    require_once(ABSPATH . 'src/function/admin_updateTQF.class.php');
    $tqf = new admin_updateTQF();
}
else if($_GET['method'] == 'admin_delete_tqf'){
    require_once(ABSPATH . 'src/function/admin_deleteTQF.class.php');
    $tqf = new admin_deleteTQF();
}

////////// News

else if($_GET['method'] == 'admin_create_news'){
    require_once(ABSPATH . 'src/function/admin_createNews.class.php');
    $news = new admin_createNews();
}
else if($_GET['method'] == 'admin_update_news'){
    require_once(ABSPATH . 'src/function/admin_updateNews.class.php');
    $news = new admin_updateNews();
}
else if($_GET['method'] == 'admin_delete_news'){
    require_once(ABSPATH . 'src/function/admin_deleteNews.class.php');
    $news = new admin_deleteNews();
}

////////// Course

else if($_GET['method'] == 'admin_create_course'){
    require_once(ABSPATH . 'src/function/admin_createCourse.class.php');
    $course = new admin_createCourse();
}
else if($_GET['method'] == 'admin_update_course'){
    require_once(ABSPATH . 'src/function/admin_updateCourse.class.php');
    $course = new admin_updateCourse();
}
else if($_GET['method'] == 'admin_delete_course'){
    require_once(ABSPATH . 'src/function/admin_deleteCourse.class.php');
    $course = new admin_deleteCourse();
}

////////// project sql command
else if($_GET['method'] == 'create_project'){
    require_once(ABSPATH . 'src/function/createProject.class.php');
    $project = new createProject();

}else if($_GET['method'] == 'update_project'){
    require_once(ABSPATH . 'src/function/updateProject.class.php');
    $project = new updateProject();

}
else if($_GET['method'] == 'delete_project'){
    require_once(ABSPATH . 'src/function/deleteProject.class.php');
    $project = new deleteProject();

}

//// profile

else if($_GET['method'] == 'admin_update_profile'){
    require_once(ABSPATH . 'src/function/admin_updateProfile.class.php');
    $user = new admin_updateProfile();

}

// change password

else if($_GET['method'] == 'admin_change_password'){
    require_once(ABSPATH . 'src/function/admin_changePassword.class.php');
    $user = new admin_changePassword();

}

//// Time schedule
else if($_GET['method'] == 'admin_add_schedule'){
    require_once(ABSPATH . 'src/function/admin_add_schedule.class.php');
    $addSchedule = new admin_AddSchedule();
    echo "<meta http-equiv=\"refresh\" content=\"0; url=". site_url ."/admin_time_schedule.php\" />";

}


// **************************************** President ***************************************


////////// conference sql command
if($_GET['method'] == 'president_create_conference'){
    require_once(ABSPATH . 'src/function/president_createConference.class.php');
    $conference = new president_createConference();
}
else if($_GET['method'] == 'president_update_conference'){
    require_once(ABSPATH . 'src/function/president_updateConference.class.php');
    $conference = new president_updateConference();
}
else if($_GET['method'] == 'president_delete_conference'){
    require_once(ABSPATH . 'src/function/president_deleteConference.class.php');
    $conference = new president_deleteConference();
}
////////// research sql command
else if($_GET['method'] == 'president_create_research'){
    require_once(ABSPATH . 'src/function/president_createResearch.class.php');
    $research = new president_createResearch();

}else if($_GET['method'] == 'president_update_research'){
    require_once(ABSPATH . 'src/function/president_updateResearch.class.php');
    $research = new president_updateResearch();

}
else if($_GET['method'] == 'president_delete_research'){
    require_once(ABSPATH . 'src/function/president_deleteResearch.class.php');
    $research = new president_deleteResearch();

}
////////// advisor sql command
else if($_GET['method'] == 'president_create_advisor'){
    require_once(ABSPATH . 'src/function/president_createAdvisor.class.php');
    $advisor = new president_createAdvisor();

}else if($_GET['method'] == 'president_update_advisor'){
    require_once(ABSPATH . 'src/function/president_updateAdvisor.class.php');
    $advisor = new president_updateAdvisor();

}
else if($_GET['method'] == 'president_delete_advisor'){
    require_once(ABSPATH . 'src/function/president_deleteAdvisor.class.php');
    $advisor = new president_deleteAdvisor();

}

//// Time schedule
else if($_GET['method'] == 'president_add_schedule'){
    require_once(ABSPATH . 'src/function/president_add_schedule.class.php');
    $addSchedule = new president_AddSchedule();
    echo "<meta http-equiv=\"refresh\" content=\"0; url=". site_url ."/president_time_schedule.php\" />";

}

////////// TQF sql command
else if($_GET['method'] == 'president_create_tqf'){
    require_once(ABSPATH . 'src/function/president_createTQF.class.php');
    $tqf = new president_createTQF();
}
else if($_GET['method'] == 'president_update_tqf'){
    require_once(ABSPATH . 'src/function/president_updateTQF.class.php');
    $tqf = new president_updateTQF();
}
else if($_GET['method'] == 'president_delete_tqf'){
    require_once(ABSPATH . 'src/function/president_deleteTQF.class.php');
    $tqf = new president_deleteTQF();

////////// USER sql command
}
else if($_GET['method'] == 'register'){
    require_once(ABSPATH . 'src/function/register.class.php');
    $register = new RegisterAction();
}


//// profile

else if($_GET['method'] == 'president_update_profile'){
    require_once(ABSPATH . 'src/function/president_updateProfile.class.php');
    $user = new president_updateProfile();

}

//  update_project

else if($_GET['method'] == 'president_update_project'){
    require_once(ABSPATH . 'src/function/president_updateProject.class.php');
    $project = new president_updateProject();

}

// change password

else if($_GET['method'] == 'president_change_password'){
    require_once(ABSPATH . 'src/function/president_changePassword.class.php');
    $user = new president_changePassword();

}

//  update_project

else if($_GET['method'] == 'president_update_project'){
    require_once(ABSPATH . 'src/function/president_updateProject.class.php');
    $project = new president_updateProject();

}

//  search_conference

else if($_GET['method'] == 'president_search_conference'){
    require_once(ABSPATH . 'src/function/president_searchConference.class.php');
    $conference = new president_searchConference();

}

//  search_research

else if($_GET['method'] == 'president_search_research'){
    require_once(ABSPATH . 'src/function/president_searchResearch.class.php');
    $research = new president_searchResearch();

}

//  search_project

else if($_GET['method'] == 'president_search_project'){
    require_once(ABSPATH . 'src/function/president_searchProject.class.php');
    $project = new president_searchProject();

}
//  search_advisor

else if($_GET['method'] == 'president_search_advisor'){
    require_once(ABSPATH . 'src/function/president_searchAdvisor.class.php');
    $advisor = new president_searchAdvisor();

}
//  search_TQF

else if($_GET['method'] == 'president_search_TQF'){
    require_once(ABSPATH . 'src/function/president_searchTQF.class.php');
    $tqf = new president_searchTQF();

}


?>