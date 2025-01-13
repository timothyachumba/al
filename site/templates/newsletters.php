<?php

$action = get('action');

if ($action === 'confirm') {
 echo "this is a confirmation page";
} elseif ($action === 'subscribe')  {
  // Handle subscribe
} elseif ($action === 'alreadysubscribed')  {
  // Handle already subscribed
} elseif ($action === 'unsubscribed') {
  // Handle unsubscribed
} else {
  go($page->children()->listed()->first()?->url() ?? 'home');
  exit;
}
?>
