<?php

if(Session::has('flash_message')){ ?>
<div class="alert alert-{!! Session::get('flash_level') !!}" id="msg_box" style="margin-bottom: 0px;">
    <h5 class="text-center">{!! Session::get('flash_message') !!}</h5>
</div>
<?php
}?>
