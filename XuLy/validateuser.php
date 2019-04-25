<?php
    require('../XuLy/conSQL.php');
    session_start();
    if(isset($_SESSION["isLOGIN"]) && $_SESSION["isLOGIN"] == 1)
    {
        logout();
    }
    else
    {
        $username = $_POST['username'];
        $pass = $_POST['password'];
        // echo $_POST['password'];
        echo password_hash($pass , PASSWORD_DEFAULT)."<br>";
        $sql = "SELECT * FROM user WHERE userNAME='$username'";
        echo $sql.'<br>';
        $result = conSQL::executeQuery($sql);
        while($row = mysqli_fetch_array($result))
        {
            echo "ABC<br>";
            echo $row["userPass"]."<br>";
            // echo password_verify($pass,$row["userPass"])."</br>"; 
            if(password_verify($pass,$row["userPass"])) 
            {
                echo "Đăng nhập";  
                $_SESSION["isLOGIN"] = 1;
                $_SESSION["userName"] = $row["userName"];
                $_SESSION["AUTHENTICATION"] = $row["userAuthentication"];
            }else{
                echo "sai";
            }
        }
    }
    header("Location: ../index.php");
    function logout()
    {
        unset($_SESSION["userName"]);
        unset($_SESSION["AUTHENTICATION"]);
        $_SESSION['isLOGIN'] = 0;
    }
?>