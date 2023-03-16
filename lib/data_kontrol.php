<!--PHP'de MySQL veritabanından kayıt getirip getirmediğinizi kontrol etmek için genellikle sorgunun sonucunu kontrol edersiniz. Sorgunun sonucu, veritabanından döndürülen satırların sayısını içeren bir sayıdır. Eğer sorgu veritabanından kayıt getirdiyse, sayı 0'dan büyük olacaktır. Aksi takdirde, sayı 0 olacaktır.-->
<!---->
<!--Aşağıdaki örnek kodda, "users" adlı bir tablodan belirli bir kullanıcının kaydını almak için "SELECT" sorgusu kullanılmıştır. Sorgu sonucunda bir satır döndüğü zaman, "mysqli_num_rows" fonksiyonu 1'den büyük olacaktır. Bu durumda, kayıt getirilmiştir ve işlem yapabilirsiniz. Aksi takdirde, kayıt getirilememiştir ve hata mesajı yazdırabilirsiniz.-->
<!---->
<!--php-->
<!--Copy code-->
<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare and execute query
$sql = "SELECT * FROM users WHERE username = 'johndoe'";
$result = mysqli_query($conn, $sql);

// Check if query returned any results
if (mysqli_num_rows($result) > 0) {
    // Process the result
    $row = mysqli_fetch_assoc($result);
    echo "Username: " . $row["username"] . "<br>";
    echo "Email: " . $row["email"] . "<br>";
} else {
    // No results found
    echo "No results found.";
}

mysqli_close($conn);
?>
Bu kodu kendi veritabanınıza uyarlamak için, "localhost", "username", "password", "database", "users", ve "johndoe"
değerlerini kendi veritabanı bilgilerinizle ve kullanıcınızın adıyla değiştirmeniz gerekmektedir.