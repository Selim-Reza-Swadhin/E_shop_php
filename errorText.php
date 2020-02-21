
<?php
/*Text Error Tutorial*/
    /*function getRemainder($value1, $value2){
        return $value1 % $value2;
    }
    echo "Remainder is : ". getRemainder(10, 0);*/
?>

<?php
   function getRemainder1($value1, $value2){
        try{
            return $value1 % $value2;
        }catch (DivisionByZeroError $e){
            return $e;
        }
    }
    echo "Remainder is : ". getRemainder1(10, 0);
?>

<?php
    /*$book_name = "OOP in PHP";
    echo "Book name : $book_name";
    echo "<br> Book name A: {$book_name}";
    echo "<br> Book name B: {{$book_name}}";*/
?>