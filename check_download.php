<?php
$downloadCount = 0;
$lastDownloadTime = 0;
$startDownloadMsg = "Your download is starting...";
$failDownloadMsg = "Too many downloads";
session_start();
if (isset($_SESSION['downloadCount'])) {
    $downloadCount = $_SESSION['downloadCount'];
}
if (isset($_SESSION['lastDownloadTime'])) {
    $lastDownloadTime = $_SESSION['lastDownloadTime'];
    //if there are previous download time in session, print the last success download message
    echo $lastDownloadTime , " execute checkDownload('" , $_POST['user'] , "') returns \"" , $startDownloadMsg , "\"<br> "; 
}
//echo "<br>",$downloadCount,"<br>";

if (isset($_POST['dlbtn'])) {
    checkDownload($_POST['user']);
    //echo "<br>",$_POST['user'];
}
    function checkDownload($memberType) {
        global $downloadCount, $lastDownloadTime, $startDownloadMsg, $failDownloadMsg;
        $currentTime = date("H:i:s");
        if ($downloadCount < 1) {
            //print success download message and store the new download count and downlaod time to session
            echo $currentTime , " execute checkDownload('" , $memberType , "') returns \"" , $startDownloadMsg , "\"<br> "; 
            $downloadCount = $downloadCount + 1;
            $_SESSION['downloadCount'] = $downloadCount;
            $_SESSION['lastDownloadTime'] = $currentTime;
        }
        else if ($memberType == "member" && $downloadCount < 2) {
            //print success download message and store the new download count and downlaod time to session
            echo $currentTime , " execute checkDownload('" , $memberType , "') returns \"" , $startDownloadMsg , "\"<br> "; 
            $downloadCount = $downloadCount + 1;
            $_SESSION['downloadCount'] = $downloadCount;
            $_SESSION['lastDownloadTime'] = $currentTime;
        }
        else {
            $timestamp1 = strtotime($lastDownloadTime);
            $timestamp2 = strtotime($currentTime);
            // Calculate the time difference in seconds
            $time_difference = $timestamp2 - $timestamp1;

            // Convert seconds to hours, minutes, and seconds
            $hours = floor($time_difference / 3600);
            $minutes = floor(($time_difference % 3600) / 60);
            $seconds = $time_difference % 60;
            //echo "<br>",$seconds,"<br>";
            if ($seconds < 5) {
                //if the the wait time is lower than 5sec, then display fail to download message
                echo $currentTime , " execute checkDownload('" , $memberType , "') returns \"" , $failDownloadMsg , "\"<br> "; 
            }
            else {
                //print success download message and store the new downlaod time to session
                //since the downloadcount is useless after this, so it does not modify the download count
                echo $currentTime , " execute checkDownload('" , $memberType , "') returns \"" , $startDownloadMsg , "\"<br> "; 
                $_SESSION['downloadCount'] = $downloadCount;
                $_SESSION['lastDownloadTime'] = $currentTime;
            }
        }
    }
?>

<html>
<body>
 
<form action = "check_download.php" method="post">
    <input type="submit" name="dlbtn" class="button" value="Download" />
    <input type="hidden" id='user' name='user' value="<?php echo $_POST['user'] ?>" />
</form>

<form action ="homepage.php" method="post">
    <input type="submit" name="homebtn" class="button" value="Back" />
</form>

</body>
</html>