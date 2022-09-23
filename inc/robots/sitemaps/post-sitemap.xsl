<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
                xmlns:html="http://www.w3.org/TR/REC-html40"
				xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
                xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
	<xsl:template match="/">
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<title>XML Sitemap</title>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<link rel="stylesheet" type="text/css" href="inc/robots/sitemaps/css.css" />
			</head>
			<body>
				<div id="header" class="full">
					<h1>XML Sitemap</h1>
					<div id="header-des">
						<p>Xây dựng và phát triển bởi <a href="http://zland.vn">ZLAND JSC</a></p>
					</div>
				</div>				
				
				<div id="bread-crumb" class="full"><a href="sitemap.xml">Quay về Sitemap Index</a></div>
				
				<div class="full" id="content">
					<h2>Sitemap chứa tất cả <xsl:value-of select="count(sitemap:urlset/sitemap:url)"/> URL</h2>
					<div class="content">
						<table>
							<thead>
								<tr>
									<th  class="name post" width="65%">URL</th>
									<th  title="Index Priority" width="12%">Mức ưu tiên</th>
									<th width="8%">Hình ảnh</th>
									<th title="Change Frequency" width="5%">Freq.</th>
									<th class="update-time post" title="Last Modification Time" width="10%">Cập nhật cuối</th>								  
								</tr>
							</thead>
							<tbody>
								<xsl:variable name="lower" select="'abcdefghijklmnopqrstuvwxyz'"/>
								<xsl:variable name="upper" select="'ABCDEFGHIJKLMNOPQRSTUVWXYZ'"/>
								<xsl:for-each select="sitemap:urlset/sitemap:url">
									<tr>
										<td class="name post" width="65%">
											<xsl:variable name="itemURL">
												<xsl:value-of select="sitemap:loc"/>
											</xsl:variable>
											<a href="{$itemURL}">
												<xsl:value-of select="sitemap:loc"/>
											</a>
										</td>
										<td width="12%">
											<xsl:value-of select="concat(sitemap:priority*100,'%')"/>
										</td>
										<td width="8%">
											<xsl:value-of select="count(image:image)"/>
										</td>
										<td>
											<xsl:value-of select="concat(translate(substring(sitemap:changefreq, 1, 1),concat($lower, $upper),concat($upper, $lower)),substring(sitemap:changefreq, 2))"/>
										</td>
										<td>
											<xsl:value-of select="concat(substring(sitemap:lastmod,0,11),concat(' ', substring(sitemap:lastmod,12,5)))"/>
										</td>
									</tr>
								</xsl:for-each>							 
							</tbody>
						</table>
					</div>
				</div>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>