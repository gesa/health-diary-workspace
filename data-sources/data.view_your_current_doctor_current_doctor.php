<?php

	require_once(TOOLKIT . '/class.datasource.php');

	Class datasourceview_your_current_doctor_current_doctor extends SectionDatasource {

		public $dsParamROOTELEMENT = 'view-your-current-doctor-current-doctor';
		public $dsParamORDER = 'desc';
		public $dsParamPAGINATERESULTS = 'yes';
		public $dsParamLIMIT = '1';
		public $dsParamSTARTPAGE = '1';
		public $dsParamREDIRECTONEMPTY = 'no';
		public $dsParamREQUIREDPARAM = '$id';
		public $dsParamSORT = 'system:id';
		public $dsParamASSOCIATEDENTRYCOUNTS = 'no';
		

		public $dsParamFILTERS = array(
				'id' => '{$id}',
		);
		

		public $dsParamINCLUDEDELEMENTS = array(
				'name',
				'specialty',
				'phone',
				'fax',
				'affiliation',
				'location',
				'suite',
				'patient',
				'comment: formatted'
		);
		

		public function __construct($env=NULL, $process_params=true) {
			parent::__construct($env, $process_params);
			$this->_dependencies = array();
		}

		public function about() {
			return array(
				'name' => 'View: Your Current Doctor: Current Doctor',
				'author' => array(
					'name' => 'Bernard Yu',
					'website' => 'http://projects.enguin.com/health-diary',
					'email' => 'bernard@enguin.com'),
				'version' => 'Symphony 2.3.2',
				'release-date' => '2013-07-11T18:06:34+00:00'
			);
		}

		public function getSource() {
			return '8';
		}

		public function allowEditorToParse() {
			return true;
		}

		public function execute(array &$param_pool = null) {
			$result = new XMLElement($this->dsParamROOTELEMENT);

			try{
				$result = parent::execute($param_pool);
			}
			catch(FrontendPageNotFoundException $e){
				// Work around. This ensures the 404 page is displayed and
				// is not picked up by the default catch() statement below
				FrontendPageNotFoundExceptionHandler::render($e);
			}
			catch(Exception $e){
				$result->appendChild(new XMLElement('error', $e->getMessage()));
				return $result;
			}

			if($this->_force_empty_result) $result = $this->emptyXMLSet();

			return $result;
		}

	}
