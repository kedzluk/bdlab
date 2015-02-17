<?php

/*
Plugin Name: Strona Domowa
Author: lk346959
 */

function rmlc_install()
{
    global $wpdb;
    $prefix = $wpdb->prefix;
    $tablename = $prefix . "employment";
    $sql = "CREATE TABLE $tablename (
            userid int(11) NOT NULL,
            company varchar(255) NOT NULL,
            time int(11) NOT NULL,
            role varchar(255) NOT NULL,
        )";
    dbDelta($sql);

    $tablename = $prefix . "portfolio";
    $sql = "CREATE TABLE $tablename (
            userid int(11) NOT NULL,
            description varchar(255) NOT NULL,
            role varchar(255) NOT NULL,
            link varchar(255) NOT NULL,
        )";
    dbDelta($sql);

    $tablename = $prefix . "prizes";
    $sql = "CREATE TABLE $tablename (
            userid int(11) NOT NULL,
            name varchar(255) NOT NULL,
            date datetime NOT NULL,
            info varchar(255) NOT NULL,
            link varchar(255) NOT NULL,
        )";
    dbDelta($sql);

    $tablename = $prefix . "technology";
    $sql = "CREATE TABLE $tablename (
            userid int(11) NOT NULL,
            name varchar(255) NOT NULL,
            experience varchar(255) NOT NULL,
            link varchar(255) NOT NULL,
        )";
    dbDelta($sql);
}

function rmlc_uninstall()
{
    global $wpdb;
    $prefix = $wpdb->prefix;
    $tablename = $prefix . "employment";
    $wpdb->query("DROP TABLE IF EXISTS " . $tablename);
    $tablename = $prefix . "portfolio";
    $wpdb->query("DROP TABLE IF EXISTS " . $tablename);
    $tablename = $prefix . "prizes";
    $wpdb->query("DROP TABLE IF EXISTS " . $tablename);
    $tablename = $prefix . "technology";
    $wpdb->query("DROP TABLE IF EXISTS " . $tablename);
}

// 1.
add_shortcode('plan', 'timetable');
function timetable()
{
    global $current_user;
    global $wpdb;
    $sql = "SELECT * FROM ".($wpdb->prefix)."timetable WHERE userid=";
    $sql .= "(SELECT identifier FROM ".($wpdb->prefix)."wslusersprofiles WHERE user_id=".$current_user->id.")";
 
    $result = $wpdb->get_results($sql);

    echo "Plan na tydzien:</br>";
    if ($result)
    {
        echo "<table>";
        foreach ($result as $row)
        {
            echo "<tr>";
            echo "<td>";
            echo $row->name;
            echo "</td>";
            echo "<td>";
            echo $row->start_time;
            echo "</td>";
            echo "<td>";
            echo $row->end_time;
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else
    {
        echo "Brak planu</br>";
    }
}

// 2.
add_shortcode('zaliczone', 'passed');
function passed()
{
    global $current_user;
    global $wpdb;
    $sql = "SELECT * FROM ".($wpdb->prefix)."courses WHERE userid=";
    $sql .= "(SELECT identifier FROM ".($wpdb->prefix)."wslusersprofiles WHERE user_id=".$current_user->id.")";
 
    $result = $wpdb->get_results($sql);

    echo "Togo juz sie nauczyl:</br>";
    if ($result)
    {
        echo "<ul>";
        foreach ($result as $row)
        {
            echo "<li>";
            echo $row->name;
            echo "</li>";
        }
        echo "</ul>";
    }
    else
    {
        echo "Brak przedmiotow</br>";
    }
}

// 3.
add_shortcode('uczyteraz', 'nowlearning');
function nowlearning()
{
    global $current_user;
    global $wpdb;
    $sql = "SELECT * FROM ".($wpdb->prefix)."currentcourses WHERE userid=";
    $sql .= "(SELECT identifier FROM ".($wpdb->prefix)."wslusersprofiles WHERE user_id=".$current_user->id.")";
 
    $result = $wpdb->get_results($sql);

    echo "Teraz uczy sie:</br>";
    if ($result)
    {
        echo "<ul>";
        foreach ($result as $row)
        {
            echo "<li>";
            echo $row->name;
            echo "</li>";
        }
        echo "</table>";
    }
    else
    {
        echo "Brak przedmiotow</br>";
    }
}

// 4.
add_shortcode('zatrudnienie', 'employment');
function employment()
{
    global $current_user;
    global $wpdb;
    $sql = "SELECT * FROM ".($wpdb->prefix)."employment WHERE userid=";
    $sql .= "(SELECT identifier FROM ".($wpdb->prefix)."wslusersprofiles WHERE user_id=".$current_user->id.")";
 
    $result = $wpdb->get_results($sql);

    echo "Zatrudnienie:</br>";
    if ($result)
    {
        echo "<ul>";
        foreach ($result as $row)
        {
            echo "<li>";
            echo $row->company." - ".$row->time." mies. - ".$row->role;
            echo "</li>";
        }
        echo "</ul>";
    }
    else
    {
        echo "Brak zatrudnien</br>";
    }
}

// 5.
add_shortcode('portfolio', 'portfolio');
function portfolio()
{
    global $current_user;
    global $wpdb;
    $sql = "SELECT * FROM ".($wpdb->prefix)."portfolio WHERE userid=";
    $sql .= "(SELECT identifier FROM ".($wpdb->prefix)."wslusersprofiles WHERE user_id=".$current_user->id.")";
 
    $result = $wpdb->get_results($sql);

    echo "Portfolio:</br>";
    if ($result)
    {
        echo "<ul>";
        foreach ($result as $row)
        {
            echo "<li>";
            echo $row->description." - ".$row->role." - <a href=\"".$row->link."\">Probka</a>";
            echo "</li>";
        }
        echo "</ul>";
    }
    else
    {
        echo "Brak projektow w portfolio</br>";
    }
}

// 6.
add_shortcode('technologie', 'technologies');
function technologies()
{
    global $current_user;
    global $wpdb;
    $dzialaj = 1;
    if (isset($_POST["prizename"]))
    {
        $prizeuserid = $_POST["prizeuserid"];
        $prizename = filter_var($_POST["prizename"], FILTER_SANITIZE_STRING);
        if (!$prizename)
        {
            echo "Brak nazwy!</br>";
            $dzialaj = 0;
        }
        $prizeexperience = filter_var($_POST["prizeexperience"], FILTER_SANITIZE_STRING);
        if (!$prizeexperience)
        {
            echo "Brak doswiadczenia!</br>";
            $dzialaj = 0;
        }
        $prizelink = filter_var($_POST["prizelink"], FILTER_SANITIZE_URL);
        if (!filter_var($prizelink, FILTER_VALIDATE_URL))
        {
            echo "Zly link!</br>";
            $dzialaj = 0;
        }
        if ($dzialaj == 1)
        {
            $sql='INSERT INTO lk346959.technologies(userid, name, experience, link) VALUES (\''.$prizeuserid.'\',\''.$prizename.'\', \''.$prizeexperience.'\', \''.$prizelink.'\')';
            $wpdb->query($sql);
            echo '<h1>Dodany nowy wpis!</h1></br></br>';
        }
    }
    $sql = "SELECT * FROM ".($wpdb->prefix)."technologies WHERE userid=";
    $numerek .= "(SELECT identifier FROM ".($wpdb->prefix)."wslusersprofiles WHERE user_id=".$current_user->id.")";
    $sql .= $numerek;
 
    $result = $wpdb->get_results($sql);

    echo "Technologie:</br>";
    if ($result)
    {
        echo "<ul>";
        foreach ($result as $row)
        {
            echo "<li>";
            echo $row->name." - ".$row->experience." - <a href=\"".$row->link."\">Probka</a>";
            echo "</li>";
        }
        echo "</ul>";
    }
    else
    {
        echo "Brak technologii</br>";
    }
    
    $res2 = $wpdb->get_col($numerek);
 
    echo 'Dodaj technologie:</br>
        <form method="post" action="">
        Nazwa: <input type="text" name="prizename"></br>
        Doswiadczenie: <input type="text" name="prizeexperience"></br>
        Probka: <input type="text" name="prizelink"></br>
        <input type="hidden" name="prizeuserid" value="'.$res2[0].'">
        <input type="submit" name="button">
        </form>
        ';
}

// 7.
add_shortcode('nagrody', 'prizes');
function prizes()
{
    global $current_user;
    global $wpdb;
    $sql = "SELECT * FROM ".($wpdb->prefix)."prizes WHERE userid=";
    $sql .= "(SELECT identifier FROM ".($wpdb->prefix)."wslusersprofiles WHERE user_id=".$current_user->id.")";
    $result = $wpdb->get_results($sql);

    echo "Nagrody:</br>";
    if ($result)
    {
        echo "<ul>";
        foreach ($result as $row)
        {
            echo "<li>";
            echo $row->name." - ".$row->date." - ".$row->info." - <a href=\"".$row->link."\">Probka</a>";
            echo "</li>";
        }
        echo "</ul>";
    }
    else
    {
        echo "Brak nagrod</br>";
    }
}
?>

