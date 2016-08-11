<?php
/**
 Admin Page Framework v3.7.6b03 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/server-information>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
abstract class ServerInformation_AdminPageFramework_Controller_Menu extends ServerInformation_AdminPageFramework_View_Menu {
    protected $_aBuiltInRootMenuSlugs = array('dashboard' => 'index.php', 'posts' => 'edit.php', 'media' => 'upload.php', 'links' => 'link-manager.php', 'pages' => 'edit.php?post_type=page', 'comments' => 'edit-comments.php', 'appearance' => 'themes.php', 'plugins' => 'plugins.php', 'users' => 'users.php', 'tools' => 'tools.php', 'settings' => 'options-general.php', 'network admin' => "network_admin_menu",);
    public function setRootMenuPage($sRootMenuLabel, $sIcon16x16 = null, $iMenuPosition = null) {
        $sRootMenuLabel = trim($sRootMenuLabel);
        $_sSlug = $this->_isBuiltInMenuItem($sRootMenuLabel);
        $this->oProp->aRootMenu = array('sTitle' => $sRootMenuLabel, 'sPageSlug' => $_sSlug ? $_sSlug : str_replace('\\', '_', $this->oProp->sClassName), 'sIcon16x16' => $this->oUtil->getResolvedSRC($sIcon16x16), 'iPosition' => $iMenuPosition, 'fCreateRoot' => empty($_sSlug),);
    }
    private function _isBuiltInMenuItem($sMenuLabel) {
        $_sMenuLabelLower = strtolower($sMenuLabel);
        if (array_key_exists($_sMenuLabelLower, $this->_aBuiltInRootMenuSlugs)) {
            return $this->_aBuiltInRootMenuSlugs[$_sMenuLabelLower];
        }
    }
    public function setRootMenuPageBySlug($sRootMenuSlug) {
        $this->oProp->aRootMenu['sPageSlug'] = $sRootMenuSlug;
        $this->oProp->aRootMenu['fCreateRoot'] = false;
    }
    public function addSubMenuItems($aSubMenuItem1, $aSubMenuItem2 = null, $_and_more = null) {
        foreach (func_get_args() as $_aSubMenuItem) {
            $this->addSubMenuItem($_aSubMenuItem);
        }
    }
    public function addSubMenuItem(array $aSubMenuItem) {
        if (isset($aSubMenuItem['href'])) {
            $this->addSubMenuLink($aSubMenuItem);
        } else {
            $this->addSubMenuPage($aSubMenuItem);
        }
    }
    public function addSubMenuLink(array $aSubMenuLink) {
        if (!isset($aSubMenuLink['href'], $aSubMenuLink['title'])) {
            return;
        }
        if (!filter_var($aSubMenuLink['href'], FILTER_VALIDATE_URL)) {
            return;
        }
        $_oFormatter = new ServerInformation_AdminPageFramework_Format_SubMenuLink($aSubMenuLink, $this, count($this->oProp->aPages) + 1);
        $_aSubMenuLink = $_oFormatter->get();
        $this->oProp->aPages[$_aSubMenuLink['href']] = $_aSubMenuLink;
    }
    public function addSubMenuPages() {
        foreach (func_get_args() as $_aSubMenuPage) {
            $this->addSubMenuPage($_aSubMenuPage);
        }
    }
    public function addSubMenuPage(array $aSubMenuPage) {
        if (!isset($aSubMenuPage['page_slug'])) {
            return;
        }
        $_oFormatter = new ServerInformation_AdminPageFramework_Format_SubMenuPage($aSubMenuPage, $this, count($this->oProp->aPages) + 1);
        $_aSubMenuPage = $_oFormatter->get();
        $this->oProp->aPages[$_aSubMenuPage['page_slug']] = $_aSubMenuPage;
    }
}