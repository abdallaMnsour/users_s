<?php
ob_start();

include 'includes/header.php';


/*
    قم باستدعاء الملفات من ملف ال view بدلا من ان تكون الملفات موجوده بالخارج
    قم بالاعتماد علي ال $_GET لجلب الصفحات
    لا يوجد اي مشكله بالامان لانه لا يمكن للمستخدم الدخول الي هذه الصفحه اصلا اذا لم يكن مسجل
*/

// يجب ان يكون هناك ['manage'] لبدا الصفحه
if ($user_bool && isset($_GET['manage'])) {

    /* services */
    if ($_GET['manage'] == 'services') {
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'add') {
                include 'view/services/add_service.php';
            } else if ($_GET['status'] == 'update' && isset($_GET['id'])) {
                include 'view/services/update_service.php';
            }
        } else {
            include 'view/services/services.php';
        }
    /* work */
    } else if ($_GET['manage'] == 'work') {
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'add') {
                include 'view/services/add_service.php';
            } else if ($_GET['status'] == 'update' && isset($_GET['id'])) {
                include 'view/services/update_service.php';
            }
        } else {
            include 'view/work/work.php';
        }
    }

} else {
    header('location: index.php');
    exit;
}

include 'includes/footer.php';
ob_end_flush();
