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
						<p>Xây dựng và phát triển bởi <a href="http://zland.vn">ZLAND LTD</a></p>
					</div>
				</div>				

				<div class="full" id="content">
					<h2>Trang web bao gồm 3 Sitemap</h2>
					<div class="content">
						<table>
							<thead>
								<tr>
									<th class="name">Tên Sitemap</th>
									<th class="update-time">Cập nhật cuối</th>
								</tr>
							</thead>
							<tbody>
								<xsl:for-each select="sitemap:sitemapindex/sitemap:sitemap">
									<xsl:variable name="sitemapURL">
										<xsl:value-of select="sitemap:loc"/>
									</xsl:variable>
									<tr>
										<td class="name"><a href="{$sitemapURL}"><xsl:value-of select="sitemap:loc"/></a></td>
										<td class="update-time"><xsl:value-of select="sitemap:lastmod"/></td>
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