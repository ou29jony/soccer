
<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
$link = mysql_connect('192.168.0.65:3306', 'dabuladze', 'S-hi0Z65jivc');
$DB = "dabuladze_playground";
$playground = mysql_select_db('dabuladze_playground', $link);
$maindoc = new DOMDocument();
$teams = null;
$rankingtable = array();
$rankingtableList = array();
$table1Arr = array();
$allTeamsUrl = array();
$allTeams = array();
$docs = array();
        $html = "http://www.sfstats.net/soccer";
        $maindoc->loadHTMLFile($html);
        setHref();
        setDocs();
        setTeams();
        setDB();
        $time = getTime();
        getResult();
        show();
function show(){
    $html2 = "https://www.tipico.com/de/online-sportwetten/";
    $maindoc2 = new DOMDocument();
    $maindoc2->loadHTMLFile($html2);
    $divs = $maindoc2->getElementsByTagName('div');
    for($k = 0; $k < $divs->length; $k++){
        echo "<br>".$divs->item($k)->nodeValue;
    }
  }
function setAllTable($doc)
  {
    global $time;
    $table1 = $doc->getElementsByTagName('table');
    $table1 = $table1->item(0)->getElementsByTagName('td');
    $table2 = $doc->getElementsByTagName('table');
    $table2 = $table2->item(2)->getElementsByTagName('td');
    $table3 = $doc->getElementsByTagName('table');
    $table3 = $table3->item(4)->getElementsByTagName('td');
    $table1 = setTable($table1);
    $table2 = setTable($table2);
    $table3 = setLastTable($table3);
      return array(
        'table1' => $table1,
        'table2' => $table2,
        'table3' => $table3
    );
}
function getResult()
{
    global $html, $time;
    $time = setDate($time);
    $date = new DateTime($time);
    $date->modify('-1 day');
    $d = intval($date->format('d'));
    $m = intval($date->format('m'));
    $y = intval($date->format('Y'));
    $oldmaindoc = new DOMDocument();
    $firsthtml = "http://www.sfstats.net/soccer";
    $oldhtml ="http://www.sfstats.net/soccer/calendar/" . $y . "/" . $m . "/" . $d;
    $docsaraay = array( 0 =>$oldhtml  , 1 => $firsthtml);
  for($k=0; $k < 1; $k++){
       $oldmaindoc->loadHTMLFile($docsaraay[$k]);
       $tables = $oldmaindoc->getElementsByTagName('table')->item(1);
       $tds = $tables->getElementsByTagName('td');
         for ($i = 0; $i < $tds->length; $i ++) {       
           $filtertd = str_replace(' ', '', $tds->item($i)->nodeValue);
           if (preg_match('/[0-9]{1,3}:[0-9]{1,3}/', $filtertd, $result)) {
             $r = explode(':', $result[0]);
               if (! (strlen($r[0]) == 2 && strlen($r[1]) == 2)) {
                   $team1 = filter($tds->item($i - 1)->nodeValue);
                   $team2 = filter($tds->item($i + 1)->nodeValue);
                   if ($r[0] > $r[1])
                       $result1x2 = '1';
                   if ($r[1] > $r[0])
                       $result1x2 = '2';
                   if ($r[1] == $r[0])
                      $result1x2 = 'x';
                   if($k==0){
                   //  $date = new DateTime($time);
                   }else{
                   //  $date->modify('-1 day');
                   }
                   echo "<br>".$docsaraay[$k];
                setDBResult($team1, $team2, $result[0], $result1x2, $date);
               }
           }
       }
    } 
}
function setDBResult($team1, $team2, $result, $result1x2, $date)
{
    global $link, $DB,$time;
    $query = "SELECT '" . $DB . "' FROM result WHERE date='". $date->format('Y-m-d')."' AND team1 ='" . $team1 . "' AND team2='" . $team2 . "'";
    $get = mysql_query($query, $link);
    $get = mysql_num_rows($get);
   if ($get == 0) {
        $queryteam1 = "SELECT * FROM team1 WHERE date = '" . $date->format('Y-m-d') . "'  AND name = '" . $team1 . "'";
        $queryteam2 = "SELECT * FROM team2 WHERE date = '" . $date->format('Y-m-d') . "'  AND name = '" . $team2 . "'";
        $result1 = mysql_query($queryteam1, $link);
        $result2 = mysql_query($queryteam2, $link);
        $row1 = mysql_fetch_assoc($result1);
        $row2 = mysql_fetch_assoc($result2);
        $querysoccerteam = "SELECT * FROM soccerteams WHERE date = '" . $date->format('Y-m-d') . "'  AND team1id = '" . $row1['t1id'] . "'   AND  team2id = '" . $row2['t2id'] . "'  ";
        $resultsoccerteams = mysql_query($querysoccerteam, $link);
        $rowsoccerteams = mysql_fetch_assoc($resultsoccerteams);
          if ($rowsoccerteams['id']) {
                       $query = "INSERT INTO result (scteamsid, team1,team2 ,onextwo,result,date) VALUES ('" . $rowsoccerteams['id'] . "','" . $team1 . "','" . $team2 . "','" . $result1x2 . "','" . $result . "','" . $date->format('Y-m-d')  . "')";
                         mysql_query($query, $link);
        }
    }
}

function getTime()
{
    global $maindoc;
    $id = $maindoc->getElementById('contentBlock');
    $h2s = $id->getElementsByTagName('h2')->item(1)->childNodes;
    foreach ($h2s as $h2) {
        $value = trim($h2->nodeValue);
        $value = filter_var($value, FILTER_SANITIZE_URL);
        $value = explode('-', $value)[1];
             return   $value;
    }
}

function setHref()
{
    global $maindoc, $allTeamsUrl;
    $as = $maindoc->getElementsByTagName('a');
    $tds = $maindoc->getElementsByTagName('td');
    $coefficient = array();
    for ($j = 0; $j < $tds->length; $j ++) {
        $as = $tds->item($j)->getElementsByTagName('a');
        foreach ($as as $a) {
            if (preg_match('/.*compare.[0-9]*.[0-9]*/', $a->getAttribute('href'), $TeamsUrl)) {
                $team1 = filter($tds->item($j - 6)->nodeValue);
                $team2 = filter($tds->item($j - 4)->nodeValue);
                $coefficient = array(
                    'one' => $tds->item($j - 3)->nodeValue,
                    'x' => $tds->item($j - 2)->nodeValue,
                    'two' => $tds->item($j - 1)->nodeValue
                );
                array_push($allTeamsUrl, array(
                    'url' => 'http://de.sfstats.net' . $TeamsUrl[0],
                    'coefficient' => $coefficient,
                    'team1' => $team1,
                    'team2' => $team2
                ));
            }
        }
    }
}

function setDocs()
{   global $allTeamsUrl, $docs;
      for ($i = 0; $i < sizeof($allTeamsUrl); $i ++) {
        $doc = new DOMDocument();
        $doc->loadHTMLFile($allTeamsUrl[$i]['url']);
        array_push($docs, $doc);
        $doc = null;
    }
}

// Verbindung zu localhost auf port 3306
function setQuery($team, $oldpoints, $teamN)
{
    global $time;
     $date = setDate($time);
        $query = "INSERT INTO " . $teamN . " (name,pos,sp ,g,u ,v ,goals,pm,points,un,ov,streak,oldpoints,oldptcount,date) VALUES (
        '" . $team['name'] . "',
    '" . $team['pos'] . "',
    '" . $team['sp'] . "',
    '" . $team['g'] . "',
    '" . $team['u'] . "',
    '" . $team['v'] . "',
    '" . $team['goals'] . "',
    '" . $team['+/-'] . "',
    '" . $team['points'] . "',
    '" . $team['U2.5'] . "',
    '" . $team['O2.5'] . "',
    '" . $team['streak'] . "',
    '" . $oldpoints[$team['name']]['oldpoints'] . "',
    '" . $oldpoints[$team['name']]['oldptcount'] . "',
    '" . $date . "')";
    return $query;
}

function setDB()
{
    global $time, $link, $rankingtableList, $DB, $time;
    $date = setDate($time);
    $query1 = "SELECT '" . $DB . "' FROM team1 WHERE date='" . $date . "'";
    $query2 = "SELECT '" . $DB . "' FROM team2 WHERE date='" . $date . "'";
    $get1 = mysql_query($query1, $link);
    $get1 = mysql_num_rows($get1);
    $get2 = mysql_query($query2, $link);
    $get2 = mysql_num_rows($get2);
   if ($get1 == 0 && $get2 == 0) {
    for ($i = 0; $i < sizeof($rankingtableList); $i ++) {
            $team1 = $rankingtableList[$i]['team1'];
            $team2 = $rankingtableList[$i]['team2'];
            echo "<br>".$team1['name'];
            $coefficient = getCoefficient($team1['name'], $team2['name']);
            $oldpoints = $rankingtableList[$i]['tables']['oldpoints'];
            $query1 = setQuery($team1, $oldpoints, "team1");
            $query2 = setQuery($team2, $oldpoints, "team2");
            mysql_query($query1, $link);
            $id1 = mysql_insert_id();
            mysql_query($query2, $link);
            $id2 = mysql_insert_id();
            $querysoccerteams = "SELECT '" . $DB . "' FROM soccerteams WHERE team1id ='" . $id1  . "' OR team2id ='". $id2."'";
            $getsoccerteams = mysql_query($querysoccerteams, $link);
            $number = mysql_num_rows($getsoccerteams) ;
            if($number == 0){
                $querysoccerteams = "INSERT INTO soccerteams   (team1id,team2id,one,x,two,date) VALUES ('" . $id1 . "','" . $id2 . "','" . $coefficient['one'] . "','" . $coefficient['x'] . "','" . $coefficient['two'] . "','" . $date . "')";
                mysql_query($querysoccerteams, $link);
                $scteamsid = mysql_insert_id();
                setDbtable($scteamsid, $rankingtableList[$i]['tables']['table3']);
            }
        }
    }
}

function getCoefficient($team1, $team2)
{
    global $allTeamsUrl;
    foreach ($allTeamsUrl as $atu) {
        if ($atu['team1'] == $team1 && $atu['team2'] == $team2) {
                 return $atu['coefficient'];
        }
    }
}

function setDbtable($id, $table)
{
    global $link;
    foreach ($table as $td) {
     $query = "INSERT INTO against (scteamsid,date,team1,team2,result)
            VALUES
            ('" . $id . "','" . $td['date'] . "','" . $td['team1'] . "','" . $td['team2'] . "','" . $td['goals'] . "')";
          mysql_query($query, $link);
    }
}

function filter($value)
{
    $value = trim($value);
    $value = str_replace(' ', '!', $value);
    $value = filter_var($value, FILTER_SANITIZE_URL);
    $value = str_replace('!', ' ', $value);
    return $value;
}

function setTeams()
{
    global $docs, $allteams;
    $rankingtable = array();
  for ($k = 0; $k < sizeof($docs); $k ++) {
        $h1s = $docs[$k]->getElementsByTagName('h1');
        $tables = $docs[$k]->getElementsByTagName('table');
        $ids = $docs[$k]->getElementById('tab-1');
        $tds = $ids->getElementsByTagName('td');
        foreach ($h1s as $h1) {
            if (strpos($h1->nodeValue, 'vs.')) {
                $teams = $h1->nodeValue;
                $teams = explode('vs.', $teams);
                $teams[0] = filter($teams[0]);
                $teams[1] = filter($teams[1]);
                $teams = array(
                    'team1' => $teams[0],
                    'team2' => $teams[1]
                );
            }
        }
        $length = $ids->getElementsByTagName('tr')->item(0)->childNodes->length / 2;
        $table = $tables->item(0);
        $table = $table->childNodes;
        foreach ($tds as $td) {
            $vl = filter($td->nodeValue);
            array_push($rankingtable, $vl);
        }
        $tables = setAllTable($docs[$k]);
        $oldpoints = setOldGamePoints($teams, $tables['table1'], $tables['table2']);
        setRanking($rankingtable, $teams, $length, $tables, $oldpoints);
        }
 }

function setDate($str)
{
    if(preg_match("/.*-.*/",$str)){
        return $str;
    }
    $date = explode('.', $str);
    if (strlen($date[0]) == 4) {
        $date = $date[0] . '-' . $date[1] . '-' . $date[2];
    } else {
        $date = $date[2] . '-' . $date[1] . '-' . $date[0];
    }
    return $date;
}

function setLastTable($table){
    global $time;
    $time = setDate($time);
     $newtable = array();
    $newdate = new DateTime($time);
  $table1Arr = array();
    foreach ($table as $tb) {
        $value = filter($tb->nodeValue);
       array_push($table1Arr, $value);
       }
    for ($i = 0; $i < sizeof($table1Arr); $i ++) {
        $str = str_replace(' ', '', trim($table1Arr[$i]));
        preg_match('/[0-9]:[0-9]/', $str, $treffer);
        if (sizeof($treffer) == 1 ) {
            $olddate = setDate($table1Arr[$i - 2]);
            $olddate  = new DateTime($olddate);
           if($olddate->format('Y')>= $newdate->format('Y')-1){
            $exp = explode(':', $treffer[0]);
            $table1Arr[$i - 1] = trim($table1Arr[$i - 1]);
            $table1Arr[$i + 1] = trim($table1Arr[$i + 1]);
            if ($exp[0] > $exp[1]) {
                array_push($newtable, array(
                'date' => $olddate->format('Y-m-d'),
                'team1' => $table1Arr[$i - 1],
                'team2' => $table1Arr[$i + 1],
                'winner' => $table1Arr[$i - 1],
                'goals' => $treffer[0]
                ));
            } else
                if ($exp[0] < $exp[1]) {
                    array_push($newtable, array(
                    'date' => $olddate->format('Y-m-d'),
                    'team1' => $table1Arr[$i - 1],
                    'team2' => $table1Arr[$i + 1],
                    'winner' => $table1Arr[$i + 1],
                    'goals' => $treffer[0]
                    ));
                } else
                    if ($exp[0] == $exp[1]) {
                        array_push($newtable, array(
                        'date' => $olddate->format('Y-m-d'),
                        'team1' => $table1Arr[$i - 1],
                        'team2' => $table1Arr[$i + 1],
                        'winner' => 'no winner',
                        'goals' => $treffer[0]
                        ));
                   }
              }
         }
     }
     return $newtable;
}
function setTable($table)
{
    global $time;
    $newtable = array();
    $table1Arr = array();
    $time = setDate($time);
    $date = new DateTime($time);
    foreach ($table as $tb) {
        $value = filter($tb->nodeValue);
        array_push($table1Arr, $value);
         }
        for ($i = 0; $i < sizeof($table1Arr); $i ++) {
        $str = str_replace(' ', '', trim($table1Arr[$i]));
        preg_match('/[0-9]:[0-9]/', $str, $treffer);
         if (sizeof($treffer) == 1 ) {
            $exp = explode(':', $treffer[0]);
            $table1Arr[$i - 1] = trim($table1Arr[$i - 1]);
            $table1Arr[$i + 1] = trim($table1Arr[$i + 1]);
            if ($exp[0] > $exp[1]) {
                  array_push($newtable, array(
                    'date' => setDate($table1Arr[$i - 2]),
                    'team1' => $table1Arr[$i - 1],
                    'team2' => $table1Arr[$i + 1],
                    'winner' => $table1Arr[$i - 1],
                    'goals' => $treffer[0]
                ));
            } else 
                if ($exp[0] < $exp[1]) {
                     array_push($newtable, array(
                        'date' => setDate($table1Arr[$i - 2]),
                        'team1' => $table1Arr[$i - 1],
                        'team2' => $table1Arr[$i + 1],
                        'winner' => $table1Arr[$i + 1],
                        'goals' => $treffer[0]
                    ));
                } else 
                    if ($exp[0] == $exp[1]) {
                        array_push($newtable, array(
                            'date' => setDate($table1Arr[$i - 2]),
                            'team1' => $table1Arr[$i - 1],
                            'team2' => $table1Arr[$i + 1],
                            'winner' => 'no winner',
                            'goals' => $treffer[0]
                        ));
                    }
         }
    }
    return $newtable;
}

function setOldGamePoints($teams, $table1, $table2)
{
    $teams['team1'] = filter($teams['team1']);
    $teams['team2'] = filter($teams['team2']);
    $count1 = 0;
    $count2 = 0;
    for ($i = 0; $i < sizeof($table1); $i ++) {
        $table1[$i]['winner'] = filter($table1[$i]['winner']);
        $table1[$i]['team1'] = filter($table1[$i]['team1']);
        if ($table1[$i]['team1'] != $teams['team1']) {
            $team = $table1[$i]['team1'];
        } else {
            $team = $table1[$i]['team2'];
        }
          if (hasTeam($table2, $team)) {
            $count1 ++;
            if ($teams['team1'] == $table1[$i]['winner']) {
                $rankingtable[$teams['team1']]['oldpoints'] = $rankingtable[$teams['team1']]['oldpoints'] + 3;
            }
            if ($table1[$i]['winner'] == 'no winner') {
                $rankingtable[$teams['team1']]['oldpoints'] = $rankingtable[$teams['team1']]['oldpoints'] + 1;
            }
        }
    }
      for ($j = 0; $j < sizeof($table2); $j ++) {
        $table2[$j]['winner'] = filter($table2[$j]['winner']);
        $table2[$j]['team1'] = filter($table2[$j]['team1']);
        if ($table2[$j]['team1'] != $teams['team2']) {
            $team = $table2[$j]['team1'];
        } else {
            $team = $table2[$j]['team2'];
        }
           if (hasTeam($table1, $team)) {
               $count2 ++;
            if ($teams['team2'] == $table2[$j]['winner']) {
                $rankingtable[$teams['team2']]['oldpoints'] = $rankingtable[$teams['team2']]['oldpoints'] + 3;
            }
            if ($table2[$j]['winner'] == 'no winner') {
                $rankingtable[$teams['team2']]['oldpoints'] = $rankingtable[$teams['team2']]['oldpoints'] + 1;
            }
        }
    }
    $rankingtable[$teams['team2']]['oldptcount'] = $count2;
    $rankingtable[$teams['team1']]['oldptcount'] = $count1;
    return $rankingtable;
}
function hasTeam($table, $team)
{
    for ($i = 0; $i < sizeof($table); $i ++) {
        $bool = $table[$i]['team1'] == $team || $table[$i]['team2'] == $team;
        if ($bool) {
            return true;
        }
    }
    return false;
}

function setRanking($array, $team, $length, $tables, $oldpoints)
{
    $localarray = array();
    global $rankingtable, $rankingtableList;
     for ($i = 0; $i < sizeof($array); $i ++) {
        if ($array[$i] == $team['team1']) {
            if ($length == 12) {
                $localarray['team1'] = array(
                    'name' => filter($array[$i]),
                    'pos' => $array[$i - 1],
                    'sp' => $array[$i + 1],
                    'g' => $array[$i + 2],
                    'u' => $array[$i + 3],
                    'v' => $array[$i + 4],
                    'goals' => $array[$i + 5],
                    '+/-' => $array[$i + 6],
                    'points' => $array[$i + 7],
                    'U2.5' => $array[$i + 8],
                    'O2.5' => $array[$i + 9],
                    'streak' => $array[$i + 10]
                );
            }
            if ($length == 9) {
                  $localarray['team1'] = array(
                    'name' => filter($array[$i]),
                    'pos' => $array[$i - 1],
                    'sp' => $array[$i + 1],
                    'g' => $array[$i + 2],
                    'u' => $array[$i + 3],
                    'v' => $array[$i + 4],
                    'goals' => $array[$i + 5],
                    '+/-' => $array[$i + 6],
                    'points' => $array[$i + 7]
                );
            }
        }
        if ($array[$i] == $team['team2']) {
             if ($length == 12) {
                $localarray['team2'] = array(
                    'name' => filter($array[$i]),
                    'pos' => $array[$i - 1],
                    'sp' => $array[$i + 1],
                    'g' => $array[$i + 2],
                    'u' => $array[$i + 3],
                    'v' => $array[$i + 4],
                    'goals' => $array[$i + 5],
                    '+/-' => $array[$i + 6],
                    'points' => $array[$i + 7],
                    'U2.5' => $array[$i + 8],
                    'O2.5' => $array[$i + 9],
                    'streak' => $array[$i + 10]
                );
            }
            if ($length == 9) {
                $localarray['team2'] = array(
                    'name' => filter($array[$i]),
                    'pos' => $array[$i - 1],
                    'sp' => $array[$i + 1],
                    'g' => $array[$i + 2],
                    'u' => $array[$i + 3],
                    'v' => $array[$i + 4],
                    'goals' => $array[$i + 5],
                    '+/-' => $array[$i + 6],
                    'points' => $array[$i + 7]
                );
            }
        }
    }
    $localarray['tables'] = $tables;
    $localarray['tables']['oldpoints'] = $oldpoints;
    $rankingtable = $localarray;
    array_push($rankingtableList, $localarray);
}
exit();
chdir(dirname(__DIR__));
/**
 * Display all errors when APPLICATION_ENV is development.
 */
if ($_SERVER['APPLICATION_ENV'] == 'development') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}
// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
