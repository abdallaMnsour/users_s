<?php
require_once '../../connect.php';

session_start();

$errors_validate = [];

function clear($value)
{
  $value = addslashes($value);
  $value = trim($value);
  return $value;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_login'])) {

  $user = $_SESSION['user_login'];

  if (
    isset($_POST['id']) &&
    isset($_POST['title']) &&
    isset($_POST['description']) &&
    isset($_POST['client_name']) &&
    isset($_POST['date']) &&
    isset($_POST['location_work']) &&
    isset($_POST['project_link']) &&
    isset($_POST['category'])
  ) {
    $id = clear($_POST['id']);
    $title = clear($_POST['title']);
    $desc = clear($_POST['description']);
    $client_name = clear($_POST['client_name']);
    $date = clear($_POST['date']);
    $location_work = clear($_POST['location_work']);
    $project_link = clear($_POST['project_link']);
    $category = clear($_POST['category']);

    // title validate
    if (empty($title)) {
      $errors_validate['title'] = 'title cannot be empty.';
    }

    // description validate
    if (empty($desc)) {
      $errors_validate['description'] = 'Description cannot be empty.';
    } else if (strlen($desc) < 10 || strlen($desc) > 500) {
      $errors_validate['description'] = 'Description must be between 10 and 500 characters long.';
    }

    // list validate
    if (empty($client_name)) {
      $errors_validate['client_name'] = 'client name cannot be empty.';
    }

    // date validate
    if (empty($date)) {
      $errors_validate['date'] = 'date cannot be empty.';
    } else {
    	$bool_date = preg_match('/(\d){4}-(\d){2}-(\d){2}/', $date, $value);
    	if ($bool_date == 1) {
    		$date = $value[0];
    	} else {
    		$errors_validate['date'] = 'you change the input, make reload in the page and try again.';
    	}
    }


    // location work validate
    if (empty($location_work)) {
      $errors_validate['location_work'] = 'location cannot be empty.';
    }

    // link validate
    if (empty($project_link)) {
      $errors_validate['link'] = 'project link cannot be empty.';
    } else {
    	if ($val = filter_var($project_link, FILTER_VALIDATE_URL)) {
    		$project_link = $val;
    	} else {
    		$errors_validate['link'] = 'you have type validate url !';
    	}
    }

    // category work validate
    if (empty($category)) {
      $errors_validate['category'] = 'category cannot be empty.';
    }





    // image validate

    $image_bool = false;
    if (isset($_FILES['image'])) {
      $image_name = $_FILES['image']['name'];
      $image_tmp = $_FILES['image']['tmp_name'];
      $image_error = $_FILES['image']['error'];
      $image_size = $_FILES['image']['size'];
  
      if ($image_error == 0) {
        if ($image_size < (2 * 1024 * 1024)) {
          $ext = ['jpg', 'png', 'jpeg'];
          $type = explode('.', $image_name);
          $type = strtolower(end($type));
          if (in_array($type, $ext)) {
            $image = uniqid() . '.' . $type;
            // لم اقم بنقل الصوره عندي لانه اذا لم تنفذ الكويري سوف يقوم برفع صوره رغم ذلك
            $image_bool = true;
          } else {
            $errors_validate['image'] = 'you can only upload an image';
          }
        } else {
          $errors_validate['image'] = 'you\'r image is too big';
        }
      }
    }






    if (empty($errors_validate)) {

      	try {

      		// الحصول علي الصوره القديمه

	        $query = "SELECT image FROM works WHERE id = '$id'";

	        $query = mysqli_query($conn, $query);

	        $query = mysqli_fetch_assoc($query);

	        if ($image_bool) {
		        $image_old = $query['image'];
		        $query = "
			        UPDATE
			        	works
			        SET
		          		title='$title',
		          		description='$desc',
		          		client_name='$client_name',
		          		date='$date',
		          		location='$location_work',
		          		project_link='$project_link',
		          		category='$category',
		          		image='$image'
		          	WHERE
		          		id = '$id'";

	        } else {
	          	$query = "
			        UPDATE
			        	works
			        SET
		          		title='$title',
		          		description='$desc',
		          		client_name='$client_name',
		          		date='$date',
		          		location='$location_work',
		          		project_link='$project_link',
		          		category='$category'
		          	WHERE
		          		id = '$id'";
	        }

		    mysqli_query($conn, $query);

	    } catch (Exception $e) {

		    echo json_encode(['status' => $e->getMessage()]);
		    exit;
	    }

        if ($image_bool) {
	        unlink('../../../files_users/' . $user['email'] . '/work/' . $image_old);
	        move_uploaded_file($image_tmp, '../../../files_users/' . $user['email'] . '/work/' . $image);
        }

      	echo json_encode(['success' => 'work added successfully']);

    } else {
      echo json_encode($errors_validate);
    }
  } else {
    echo json_encode(['status' => 'the input fields have been manipulated, please try reloading the page.<br>If the problem persists, <a href="contact.php">please contact us.</a>']);
  }
} else {
  header('location: ../../../');
  exit;
}
