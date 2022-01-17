<?php

namespace TikTokRESTAPI\Response\Model;

use TikTokRESTAPI\AutoPropertyMapper;

/**
 * AwemeAcl.
 * 
 * @method DownloadGeneral  getDownloadGeneral()
 * @method DownloadGeneral  getDownloadMaskPanel()
 * @method int              getShareListStatus()
 * @method DownloadGeneral  getShareGeneral()
 * @method mixed            getPlatformList()
 * @method bool             isDownloadGeneral()
 * @method bool             isDownloadMaskPanel()
 * @method bool             isShareListStatus()
 * @method bool             isShareGeneral()
 * @method bool             isPlatformList()
 * @method $this            setDownloadGeneral(DownloadGeneral $value)
 * @method $this            setDownloadMaskPanel(DownloadGeneral $value)
 * @method $this            setShareListStatus(int $value)
 * @method $this            setShareGeneral(DownloadGeneral $value)
 * @method $this            setPlatformList(mixed $value)
 * @method $this            unsetDownloadGeneral()
 * @method $this            unsetDownloadMaskPanel()
 * @method $this            unsetShareListStatus()
 * @method $this            unsetShareGeneral()
 * @method $this            unsetPlatformList()
 */
class AwemeAcl extends AutoPropertyMapper
{
    const JSON_PROPERTY_MAP = [
        'download_general'      => 'DownloadGeneral',
        'download_mask_panel'   => 'DownloadGeneral',
        'share_list_status'     => 'int',
        'share_general'         => 'DownloadGeneral',
        'platform_list'         => ''
    ];
}