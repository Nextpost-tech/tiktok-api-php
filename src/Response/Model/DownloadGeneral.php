<?php

namespace TikTokRESTAPI\Response\Model;

use TikTokRESTAPI\AutoPropertyMapper;

/**
 * DownloadGeneral.
 * 
 * @method int      getCode()
 * @method int      getShowType()
 * @method int      getTranscode()
 * @method bool     getMute()
 * @method bool     isCode()
 * @method bool     isShowType()
 * @method bool     isTranscode()
 * @method bool     isMute()
 * @method $this    setCode(int $value)
 * @method $this    setShowType(int $value)
 * @method $this    setTranscode(int $value)
 * @method $this    setMute(bool $value)
 * @method $this    unsetCode()
 * @method $this    unsetShowType()
 * @method $this    unsetTranscode()
 * @method $this    unsetMute()
 */
class DownloadGeneral extends AutoPropertyMapper
{
    const JSON_PROPERTY_MAP = [
        'code'      => 'int',
        'show_type' => 'int',
        'transcode' => 'int',
        'mute'      => 'bool'
    ];
}