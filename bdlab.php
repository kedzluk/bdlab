<?php
/*
Plugin Name: Strona Domowa
Author: lk346959
 */

// 1.
add_shortcode('plan', 'timetable');
function timetable()
{
    $servername = "labdb.mimuw.edu.pl";
    $username = "lk346959";
    $password = "ClujeeHinMyffeb\"";
    $dbname = "lk346959";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error() . "</br>");
    }
    //echo "Connected successfully</br>";
    global $current_user;
    global $wpdb;
    $sql = "SELECT * FROM ".($wpdb->prefix)."timetable WHERE userid=";
    $sql .= "(SELECT identifier FROM ".($wpdb->prefix)."wslusersprofiles WHERE user_id=".$current_user->id.")";
 
    $result = mysqli_query($conn, $sql);

    echo "Plan na tydzien:</br>";
    if (mysqli_num_rows($result) > 0)
    {
        echo "<table>";
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<tr>";
            echo "<td>";
            echo $row["name"];
            echo "</td>";
            echo "<td>";
            echo $row["start_time"];
            echo "</td>";
            echo "<td>";
            echo $row["end_time"];
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else
    {
        echo "Brak planu</br>";
    }
    mysqli_close($conn);
}

// 2.
add_shortcode('zaliczone', 'passed');
function passed()
{
    $servername = "labdb.mimuw.edu.pl";
    $username = "lk346959";
    $password = "ClujeeHinMyffeb\"";
    $dbname = "lk346959";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error() . "</br>");
    }
    //echo "Connected successfully</br>";
    global $current_user;
    global $wpdb;
    $sql = "SELECT * FROM ".($wpdb->prefix)."courses WHERE userid=";
    $sql .= "(SELECT identifier FROM ".($wpdb->prefix)."wslusersprofiles WHERE user_id=".$current_user->id.")";
 
    $result = mysqli_query($conn, $sql);

    echo "Togo juz sie nauczyl:</br>";
    if (mysqli_num_rows($result) > 0)
    {
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<li>";
            echo "</li>";
        }
        echo "</ul>";
    }
    else
    {
        echo "Brak przedmiotow</br>";
    }
    mysqli_close($conn);
}

// 3.
add_shortcode('uczyteraz', 'nowlearning');
function nowlearning()
{
    $servername = "labdb.mimuw.edu.pl";
    $username = "lk346959";
    $password = "ClujeeHinMyffeb\"";
    $dbname = "lk346959";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error() . "</br>");
    }
    //echo "Connected successfully</br>";
    global $current_user;
    global $wpdb;
    $sql = "SELECT * FROM ".($wpdb->prefix)."currentcourses WHERE userid=";
    $sql .= "(SELECT identifier FROM ".($wpdb->prefix)."wslusersprofiles WHERE user_id=".$current_user->id.")";
 
    $result = mysqli_query($conn, $sql);

    echo "Teraz uczy sie:</br>";
    if (mysqli_num_rows($result) > 0)
    {
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<li>";
            echo $row["name"];
            echo "</li>";
        }
        echo "</table>";
    }
    else
    {
        echo "Brak przedmiotow</br>";
    }
    mysqli_close($conn);
}

// 4.
add_shortcode('zatrudnienie', 'employment');
function employment()
{
    $servername = "labdb.mimuw.edu.pl";
    $username = "lk346959";
    $password = "ClujeeHinMyffeb\"";
    $dbname = "lk346959";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error() . "</br>");
    }
    //echo "Connected successfully</br>";
    global $current_user;
    global $wpdb;
    $sql = "SELECT * FROM employment WHERE userid=";
    $sql .= "(SELECT identifier FROM ".($wpdb->prefix)."wslusersprofiles WHERE user_id=".$current_user->id.")";
 
    $result = mysqli_query($conn, $sql);

    echo "Zatrudnienie:</br>";
    if (mysqli_num_rows($result) > 0)
    {
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<li>";
            echo $row["company"]." - ".$row["time"]." mies. - ".$row["role"];
            echo "</li>";
        }
        echo "</ul>";
    }
    else
    {
        echo "Brak zatrudnien</br>";
    }
    mysqli_close($conn);
}

// 5.
add_shortcode('portfolio', 'portfolio');
function portfolio()
{
    $servername = "labdb.mimuw.edu.pl";
    $username = "lk346959";
    $password = "ClujeeHinMyffeb\"";
    $dbname = "lk346959";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error() . "</br>");
    }
    //echo "Connected successfully</br>";
    global $current_user;
    global $wpdb;
    $sql = "SELECT * FROM portfolio WHERE userid=";
    $sql .= "(SELECT identifier FROM ".($wpdb->prefix)."wslusersprofiles WHERE user_id=".$current_user->id.")";
 
    $result = mysqli_query($conn, $sql);

    echo "Portfolio:</br>";
    if (mysqli_num_rows($result) > 0)
    {
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<li>";
            echo $row["description"]." - ".$row["role"]." - <a href=\"".$row["link"]."\">Probka</a>";
            echo "</li>";
        }
        echo "</ul>";
    }
    else
    {
        echo "Brak projektow w portfolio</br>";
    }
    mysqli_close($conn);
}

// 6.
add_shortcode('technologie', 'technologies');
function technologies()
{
    $servername = "labdb.mimuw.edu.pl";
    $username = "lk346959";
    $password = "ClujeeHinMyffeb\"";
    $dbname = "lk346959";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error() . "</br>");
    }
    //echo "Connected successfully</br>";
    global $current_user;
    global $wpdb;
    $sql = "SELECT * FROM technologies WHERE userid=";
    $sql .= "(SELECT identifier FROM ".($wpdb->prefix)."wslusersprofiles WHERE user_id=".$current_user->id.")";
 
    $result = mysqli_query($conn, $sql);

    echo "Technologie:</br>";
    if (mysqli_num_rows($result) > 0)
    {
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<li>";
            echo $row["name"]." - ".$row["experience"]." - <a href=\"".$row["link"]."\">Probka</a>";
            echo "</li>";
        }
        echo "</ul>";
    }
    else
    {
        echo "Brak technologii</br>";
    }
    mysqli_close($conn);
}

// 7.
add_shortcode('nagrody', 'prizes');
function prizes()
{
    $servername = "labdb.mimuw.edu.pl";
    $username = "lk346959";
    $password = "ClujeeHinMyffeb\"";
    $dbname = "lk346959";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error() . "</br>");
    }
    //echo "Connected successfully</br>";
    global $current_user;
    global $wpdb;
    $sql = "SELECT * FROM prizes WHERE userid=";
    $sql .= "(SELECT identifier FROM ".($wpdb->prefix)."wslusersprofiles WHERE user_id=".$current_user->id.")";
 
    $result = mysqli_query($conn, $sql);

    echo "Nagrody:</br>";
    if (mysqli_num_rows($result) > 0)
    {
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<li>";
            echo $row["name"]." - ".$row["date"]." - ".$row["info"]." - <a href=\"".$row["link"]."\">Probka</a>";
            echo "</li>";
        }
        echo "</ul>";
    }
    else
    {
        echo "Brak nagrod</br>";
    }
    mysqli_close($conn);
}
?>


