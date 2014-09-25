<?php
/*
Plugin Name: A Day in the Life post additional fields 
Description: Provides additional fields on the post which serve as a questionnaire to gather information about the user submitting the story.
Author: Neontribe
Author URI: http://www.neontribe.co.uk
*/ 

/**
* Add metabox below editing pane
*/
function dil_metabox_further_info() {
  add_meta_box( 
    'further-info', 
    'Further Information', 
    'dil_further_info_metabox_content', 
    'post', 
    'advanced', 
    'high' 
  );
} 
add_action( 'add_meta_boxes', 'dil_metabox_further_info' );

/**
 * callback function to populate metabox
 */
function dil_further_info_metabox_content( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'dil_nonce' );
  $dil_stored_meta = get_post_meta( $post->ID );
?> 
<p>
  These drop downs will help us to get a bit more background about you. You can choose ‘prefer not to say’ for any that you are not comfortable answering.
</p>
<p>
  We’re asking for this information so we can tell more interesting stories once everyone’s Days are collected together like ‘Of gay women in the north west who experience anxiety X% mentioned that their family has a positive effect on their wellbeing’.
</p>
<p>
  This information is attached to your day, not your account.  We won’t use it for any other purpose than categorising your Day.
</p>
<label for="age">Age</label>
  <select name="age" id="age">
    <option value="">Prefer not to say</option>
    <?php
    $age_options = array('18-21','22-30','31-40','41-50', '51-60', '61-70', '70+');
    _dil_build_options( $age_options, 'age', $dil_stored_meta );
    ?>
  </select>
  <label for="location">Location</label>
    <select name="location" id="location">
      <option>Prefer not to say</option>
      <optgroup label="England">
    <?php
    $counties = array (
      'Bedfordshire',
      'Berkshire',
      'Bristol',
      'Buckinghamshire',
      'Cambridgeshire',
      'Cheshire',
      'City of London',
      'Cornwall',
      'Cumbria',
      'Derbyshire',
      'Devon',
      'Dorset',
      'Durham',
      'East Riding of Yorkshire',
      'East Sussex',
      'Essex',
      'Gloucestershire',
      'Greater London',
      'Greater Manchester',
      'Hampshire',
      'Herefordshire',
      'Hertfordshire',
      'Isle of Wight',
      'Kent',
      'Lancashire',
      'Leicestershire',
      'Lincolnshire',
      'Merseyside',
      'Norfolk',
      'North Yorkshire',
      'Northamptonshire',
      'Northumberland',
      'Nottinghamshire',
      'Oxfordshire',
      'Rutland',
      'Shropshire',
      'Somerset',
      'South Yorkshire',
      'Staffordshire',
      'Suffolk',
      'Surrey',
      'Tyne and Wear',
      'Warwickshire',
      'West Midlands',
      'West Sussex',
      'West Yorkshire',
      'Wiltshire',
      'Worcestershire',
    );
    _dil_build_options( $counties, 'location', $dil_stored_meta );
?>
    </optgroup>
    <optgroup label="Wales">
    <?php
    $counties = array(
      'Anglesey',
      'Brecknockshire',
      'Caernarfonshire',
      'Carmarthenshire',
      'Cardiganshire',
      'Denbighshire',
      'Flintshire',
      'Glamorgan',
      'Merioneth',
      'Monmouthshire',
      'Montgomeryshire',
      'Pembrokeshire',
      'Radnorshire',
    );
    _dil_build_options( $counties, 'location', $dil_stored_meta );
?>
    </optgroup>
    <optgroup label="Scotland">
    <?php
    $counties = array(
      'Aberdeenshire',
      'Angus',
      'Argyllshire',
      'Ayrshire',
      'Banffshire',
      'Berwickshire',
      'Buteshire',
      'Cromartyshire',
      'Caithness',
      'Clackmannanshire',
      'Dumfriesshire',
      'Dunbartonshire',
      'East Lothian',
      'Fife',
      'Inverness-shire',
      'Kincardineshire',
      'Kinross',
      'Kirkcudbrightshire',
      'Lanarkshire',
      'Midlothian',
      'Morayshire',
      'Nairnshire',
      'Orkney',
      'Peeblesshire',
      'Perthshire',
      'Renfrewshire',
      'Ross-shire',
      'Roxburghshire',
      'Selkirkshire',
      'Shetland',
      'Stirlingshire',
      'Sutherland',
      'West Lothian',
      'Wigtownshire',
   );
    _dil_build_options( $counties, 'location', $dil_stored_meta );
?>
    </optgroup>
    <optgroup label="Northern Ireland">
    <?php
    $counties = array(
      'Antrim',
      'Armagh',
      'Down',
      'Fermanagh',
      'Londonderry',
      'Tyrone',
     );
    _dil_build_options( $counties, 'location', $dil_stored_meta );
?>
    </optgroup>
    </select>

  <label for="place">What kind of place do you live?</label>
    <select name="place" id="place">
      <option value="">Prefer not to say</option>
      <?php
     $options = array(
       'A town',
       'A city',
       'A village',
       'Other rural location',
     );
     _dil_build_options( $options, 'place', $dil_stored_meta );?>
    </select>
  <label for="health">Do you have long term physical health conditions?</label>
    <select name="health" id="health">
      <option value="">Prefer not to say</option>
      <?php
     $options = array(
       'Yes',
       'No',
     );
     _dil_build_options( $options, 'health', $dil_stored_meta );?>
    </select>
  <label for="mentalhealth">Are you currently receiving treatment for your mental health difficulties?</label>
    <select name="mentalhealth" id="mentalhealth">
      <option value="">Prefer not to say</option>
      <?php
     $options = array(
       'Yes',
       'No',
     );
     _dil_build_options( $options, 'mentalhealth', $dil_stored_meta );?>
    </select>
  <label for="gender">Gender</label>
    <select name="gender" id="gender">
      <option value="">Prefer not to say</option>
      <?php
     $options = array(
       'Female',
       'Male',
       'Trans',
       'Non binary',
     );
     _dil_build_options( $options, 'gender', $dil_stored_meta );?>
    </select>
  <label for="ethnicgroup">Choose one option that best describes your ethnic group or background</label>
    <select name="ethnicgroup" id="ethnicgroup">
      <option>Prefer not to say</option>
      <optgroup label="White">
    <?php
    $groups = array (
      'English / Welsh / Scottish / Northern Irish / British',
      'Irish',
      'Gypsy or Irish Traveller',
      'Any other White background',
    );
    _dil_build_options( $groups, 'ethnicgroup', $dil_stored_meta );
?>
    </optgroup>
    <optgroup label="Mixed / Multiple ethnic groups">
    <?php
    $groups = array(
      'White and Black Caribbean',
      'White and Black African',
      'White and Asian',
      'Any other Mixed / Multiple ethnic background',
    );
    _dil_build_options( $groups, 'ethnicgroup', $dil_stored_meta );
?>
    </optgroup>
    <optgroup label="Asian / Asian British">
    <?php
    $groups = array(
      'Indian',
      'Pakistani',
      'Bangladeshi',
      'Chinese',
      'Any other Asian background',
   );
    _dil_build_options( $groups, 'ethnicgroup', $dil_stored_meta );
?>
    </optgroup>
    <optgroup label="Black / African / Caribbean / Black British">
    <?php
    $groups = array(
      'African',
      'Caribbean',
      'Any other Black / African / Caribbean background',
     );
    _dil_build_options( $groups, 'ethnicgroup', $dil_stored_meta );
?>
    </optgroup>
    <optgroup label="Other ethnic group">
    <?php
    $groups = array(
      'Arab',
      'Other ethnic group',
     );
    _dil_build_options( $groups, 'ethnicgroup', $dil_stored_meta );
?>
    </optgroup>

  </select>

  <label for="mentaldiff">What would you say your main mental health difficulty is?</label>
    <select name="mentaldiff" id="mentaldiff">
      <option value="">Prefer not to say</option>
      <?php
      $options = array(
        'Depression',
        'Severe depression',
        'Eating disorder',
        'Anxiety disorder',
        'Anxiety / panic attacks',
        'Bipolar disorder',
        'Bipolar II disorder',
        'Body dysmorphic disorder',
        'Psychosis',
        'hearing voices', 
        'schizophrenia',
        'Borderline personality disorder',
        'Other Personality disorder',
        'Dissociative identity disorder',
        'Obsessive Compulsive disorder',
        'Phobia',
        'Post Traumatic Stress disorder',
        'Schizoaffective disorder',
        'Other condition/experience',
     );
     _dil_build_options( $options, 'mentaldiff', $dil_stored_meta );?>
    </select>
  <label for="sexuality">Sexuality - Are you</label>
    <select name="sexuality" id="sexuality">
      <option value="">Prefer not to say</option>
      <?php
      $options = array(
        'Gay',
        'Straight',
        'Bi',
        'Asexual',
        'Other',
     );
     _dil_build_options( $options, 'sexuality', $dil_stored_meta );?>
    </select>

<?php }

/**
 *  Helper to build select options
 *
 * @param $options array
 *   array of string options
 * @param $list_id string
 *   name and id of the select list
 *
 */
function _dil_build_options( $options, $list_id, $dil_stored_meta ) {
  foreach ( $options as $option ) {
    echo '<option value="' . $option  . '"';
    if ( isset ( $dil_stored_meta[$list_id] ) ) selected( $dil_stored_meta[$list_id][0], $option );
    echo '>' . $option .'</option>';
  }
}

/**
 * Save the further info values
 */
function dil_further_info_meta_save( $post_id ) {
  // Checks save status
  $is_autosave = wp_is_post_autosave( $post_id );
  $is_revision = wp_is_post_revision( $post_id );
  $is_valid_nonce = ( isset( $_POST[ 'dil_nonce' ] ) 
    && wp_verify_nonce( $_POST[ 'dil_nonce' ],
    basename( __FILE__ ) ) ) ? 'true' : 'false';
 
  // Exits script depending on save status
  if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
      return;
  }

  // Checks for input and saves if needed
  $further_info_selects = array(
          'age',
          'location',
          'place',
          'health',
          'mentalhealth',
          'gender',
          'ethnicgroup',
          'mentaldiff',
          'sexuality',
         );
  foreach ( $further_info_selects as $field ) {
    if ( isset( $_POST[ $field ] ) ) {
      update_post_meta( 
        $post_id, 
        $field, 
        $_POST[ $field ] 
      );
    }
  }
}
add_action( 'save_post', 'dil_further_info_meta_save' );
?>
