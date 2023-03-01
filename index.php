<?php
    include_once 'header.php';
    if(isset($_SESSION['userUid'])){
        echo "<p>Hello ".$_SESSION['userUid']."</p>";
    }
?>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi porta felis at justo feugiat, eget lacinia ipsum sodales. Nunc gravida mauris quis nibh molestie scelerisque. Morbi sed dui in dui fringilla finibus a in metus. Suspendisse vel bibendum ipsum. Maecenas quis sem varius, ullamcorper sem id, congue purus. Vestibulum bibendum nisl non justo sodales, faucibus molestie dui mollis. Proin tempor ex enim, at iaculis nulla tristique ut. </p>
        <p>Nam congue neque dolor, ut porttitor ipsum finibus nec. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent in venenatis magna, ut iaculis metus. Integer nunc eros, pellentesque eu lorem ac, pharetra varius lacus. Donec eleifend tortor eros, eu suscipit velit tempor ac. Pellentesque ac tristique mi, sed dignissim ipsum. Aenean sed porta mauris, eu tincidunt metus. Suspendisse efficitur ut eros sed dapibus.</p>
        <p>Suspendisse viverra et quam nec fermentum. Cras blandit elit quis iaculis consequat. Nunc leo justo, sollicitudin ut vulputate nec, ultrices eget est. Nunc ultrices arcu sit amet fermentum vehicula. In tincidunt ante quis cursus porta. Nunc vel tristique est. Nunc maximus neque nec tortor maximus, nec bibendum ligula mattis. Integer sed auctor lacus. Nullam vitae luctus arcu, quis placerat magna. Nulla facilisi. Vestibulum malesuada risus tellus, et pulvinar orci pellentesque non. Sed tristique mi molestie, pretium dui quis, dapibus orci. Phasellus condimentum varius interdum. Maecenas pretium ipsum at velit scelerisque sollicitudin. </p>

<?php
    include_once 'footer.php';
?>