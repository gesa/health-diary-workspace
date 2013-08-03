<?php

	require_once(TOOLKIT . '/class.event.php');

	Class eventprescriptions extends SectionEvent{

		public $ROOTELEMENT = 'prescriptions';

		public $eParamFILTERS = array(
			'canofspam'
		);

		public static function about(){
			return array(
				'name' => 'Prescriptions',
				'author' => array(
					'name' => 'Bernard Yu',
					'website' => 'http://projects.enguin.com/health-diary',
					'email' => 'bernard@enguin.com'),
				'version' => 'Symphony 2.3.2',
				'release-date' => '2013-07-25T23:11:45+00:00',
				'trigger-condition' => 'action[prescriptions]'
			);
		}

		public static function getSource(){
			return '4';
		}

		public static function allowEditorToParse(){
			return true;
		}

		public static function documentation(){
			return '
        <h3>Success and Failure XML Examples</h3>
        <p>When saved successfully, the following XML will be returned:</p>
        <pre class="XML"><code>&lt;prescriptions result="success" type="create | edit">
  &lt;message>Entry [created | edited] successfully.&lt;/message>
&lt;/prescriptions></code></pre>
        <p>When an error occurs during saving, due to either missing or invalid fields, the following XML will be returned:</p>
        <pre class="XML"><code>&lt;prescriptions result="error">
  &lt;message>Entry encountered errors when saving.&lt;/message>
  &lt;field-name type="invalid | missing" />
  ...
&lt;/prescriptions></code></pre>
        <p>The following is an example of what is returned if any options return an error:</p>
        <pre class="XML"><code>&lt;prescriptions result="error">
  &lt;message>Entry encountered errors when saving.&lt;/message>
  &lt;filter name="admin-only" status="failed" />
  &lt;filter name="send-email" status="failed">Recipient not found&lt;/filter>
  ...
&lt;/prescriptions></code></pre>
        <h3>Example Front-end Form Markup</h3>
        <p>This is an example of the form markup you can use on your frontend:</p>
        <pre class="XML"><code>&lt;form method="post" action="" enctype="multipart/form-data">
  &lt;input name="MAX_FILE_SIZE" type="hidden" value="2097152" />
  &lt;label>Name
    &lt;input name="fields[name]" type="text" />
  &lt;/label>
  &lt;label>Prescription?
    &lt;input name="fields[prescription]" type="checkbox" value="yes" />
  &lt;/label>
  &lt;label>Description
    &lt;textarea name="fields[description]" rows="15" cols="50">&lt;/textarea>
  &lt;/label>
  &lt;label>User
    &lt;select name="fields[user][]" multiple="multiple">
      &lt;option value="1">Bernard Yu&lt;/option>
      &lt;option value="2">Jeni Gudgeon&lt;/option>
      &lt;option value="3">Test McTestipants&lt;/option>
    &lt;/select>
  &lt;/label>
  &lt;label>Comment
    &lt;textarea name="fields[comment]" rows="15" cols="50">&lt;/textarea>
  &lt;/label>
  &lt;input name="action[prescriptions]" type="submit" value="Submit" />
&lt;/form></code></pre>
        <p>To edit an existing entry, include the entry ID value of the entry in the form. This is best as a hidden field like so:</p>
        <pre class="XML"><code>&lt;input name="id" type="hidden" value="23" /></code></pre>
        <p>To redirect to a different location upon a successful save, include the redirect location in the form. This is best as a hidden field like so, where the value is the URL to redirect to:</p>
        <pre class="XML"><code>&lt;input name="redirect" type="hidden" value="http://projects.enguin.com/health-diary/success/" /></code></pre>
        <h3>Can Of Spam Filter</h3>
        <p>To use the Can Of Spam filter, add the Can Of Spam event to your page and the following field to your form:</p>
        <pre class="XML"><code>&lt;input name="canofspam" value="{$canofspam}" type="hidden" /></code></pre>';
		}

		public function load(){
			if(isset($_POST['action']['prescriptions'])) return $this->__trigger();
		}

	}
