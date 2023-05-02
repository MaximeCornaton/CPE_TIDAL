<?php 


$last_name =  $_POST["nom"]; 
$first_name = $_POST["prenom"]; 
$mail =  $_POST["mail"];
$passwd = $_POST["password"];
$hashed_password = password_hash($passwd, PASSWORD_DEFAULT);


$query = "SELECT EXISTS (
  SELECT FROM information_schema.tables
  WHERE table_schema = 'public'
  AND table_name = 'users'
);
";

if($database->query($query)){
  $database->create_table("users", "id serial PRIMARY KEY, last_name varchar(255), first_name varchar(255), mail varchar(255) UNIQUE, passwd varchar(255), created_at timestamp DEFAULT CURRENT_TIMESTAMP");
  $query = "CREATE TABLE TJ_users_sympt (
    id_user INTEGER NOT NULL,
    id_sympt INTEGER NOT NULL,
    PRIMARY KEY (id_user, id_sympt),
    FOREIGN KEY (id_user) REFERENCES users (id),
    FOREIGN KEY (id_sympt) REFERENCES symptome (ids));";
  $database->query($query);
}


$query = "SELECT mail FROM users WHERE mail='$mail'";

$result = $database->query($query);

  if (pg_num_rows($result)>0)
  {
    $messageErreur = "Mail déjà utilisé";
    header("Location: index.php?page=signin");
    exit;
  }

  else
  {
    $sql = "INSERT INTO users (last_name, first_name, mail, passwd) VALUES ('$last_name', '$first_name', '$mail', '$hashed_password')";
    $database->query($sql);
    header("Location: index.php?page=login");
    exit;
  }

?>
