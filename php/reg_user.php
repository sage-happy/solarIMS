<?php 
    include('connection.php');
    function validate($name){
         if(preg_match('/[a-z]\w{2,23}[^_]$/i',$name)){
             return "valid";
         }else{
             return "Invalid";
        }
     }
    if($_SERVER["REQUEST_METHOD"]=="POST" && strcmp($_POST['password'], $_POST['passcmp'])==0){
        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])){
            $name=filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);        
            
            $email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
             
            $password= @password_hash($_POST['password'], $PASSWORD_BCRYPT);   
    
        //sql statement to insert data
        $sql=null;
        if(validate($name)==="valid"){
        $sql = "INSERT INTO users(name, email, password) VALUES('$name', '$email', '$password');";
        //Execute the query 
        $result = pg_query($conn, $sql);
        if($result){
            header("Location: ../index.php");
           }
        elseif(strcmp($_POST['password'], $_POST['passcmp']) != 0 ){
            echo "Password fields must match";
        }
        }else{
            //If there are errors try re-entering the details
            header("Location: signup.php");
        }
    }   
}
    pg_close($conn);

?>