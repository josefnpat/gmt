<!-- generated from http://bootsnipp.com/forms?version=3 -->

<form class="form-horizontal" method="POST" action="index.php">
<fieldset>

<!-- Form Name -->
<legend><?php echo GMT_NAME; ?></legend>

<?php
if(isset($errors) and count($errors) > 0 ){
  foreach($errors as $error){
    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>'."\n";
  }
}

if(isset($msg) and count($msg) > 0 ){
  foreach($msg as $message){
    echo '<div class="alert alert-success" role="alert">'.$message.'</div>'."\n";
  }
}


?>

<!-- Prepended text-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cost">Cost</label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">$</span>
      <input id="cost"
        name="cost"
        class="form-control"
        placeholder="1.23"
        <?php if($entry){ echo 'value="'.$entry['cost'].'"'; } ?>
        type="text"
        required="">
    </div>
    <p class="help-block">Cost of gas per gallon.</p>
  </div>
</div>

<!-- Appended Input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="distance">Distance</label>
  <div class="col-md-4">
    <div class="input-group">
      <input id="distance"
        name="distance"
        class="form-control"
        placeholder="123.4"
        <?php if($entry){ echo 'value="'.$entry['distance'].'"'; } ?>
        type="text"
        required="">
      <span class="input-group-addon">mi</span>
    </div>
    <p class="help-block">Number of miles traveled.</p>
  </div>
</div>
<!-- Appended Input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="capacity">Capacity Filled</label>
  <div class="col-md-4">
    <div class="input-group">
      <input id="capacity"
        name="capacity"
        class="form-control"
        placeholder="12.34"
        <?php if($entry){ echo 'value="'.$entry['capacity'].'"'; } ?>
        type="text"
        required="">
      <span class="input-group-addon">gal</span>
    </div>
    <p class="help-block">Number of gallons added.</p>
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="date">Date</label>  
  <div class="col-md-4">
  <input id="date"
    name="date"
    <?php if($entry){ echo 'value="'.date("Y-m-d",$entry['date']).'"'; } ?>
    type="text"
    placeholder="<?php echo date('Y-m-d'); ?>"
    class="form-control input-md">
  <span class="help-block">Date of entry</span>  
  </div>
</div>

<?php if(defined('GMT_PASS')) : ?>
<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password">Password</label>
  <div class="col-md-4">
    <input id="password" name="password" type="password" placeholder="******" class="form-control input-md" required="">
    
  </div>
</div>
<?php endif; ?>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>
</div>

</fieldset>
</form>

