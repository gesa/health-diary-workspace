<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:exslt="http://exslt.org/common"
	xmlns:date="http://exslt.org/dates-and-times"
	extension-elementPrefixes="date"
	extension-element-prefixes="exslt"
	exclude-result-prefixes="date exslt">

<xsl:import href="../utilities/api-master.xsl"/>
<!--
	Export medication diary
	URL: {$root}/export/[username]/medication
	Optional URL variables:
		`auth-token`: Secret user token to access their content without logging in
		`format`: outputs in `json` (default), `xml`, and `jsonp`
		
	Export the medication diary for the logged-in user
-->
<xsl:template match="/data">
	<xsl:copy-of select="export-medication-diary"/>
</xsl:template>
</xsl:stylesheet>