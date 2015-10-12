<?php
/**
 * Created by PhpStorm.
 * User: anthonyguertin
 * Date: 10/8/15
 * Time: 9:45 PM
 */
include_once('./connection.php');
// Header
include_once('./templates/headers/add_post_header.html');

?>

<form id="new-doc" name="new-doc" method="POST" action="./http/http_request.php">
  <label id="post-label">New Post</label><br />
  <input id="post" name="post" type="text"/> <br />
  <input id="new-doc-post" type="submit" value="submit"/>

</form>
<?
// Footer
include_once('./templates/footers/add_post_footer.html');
