<?php

require __DIR__.'/vendor/autoload.php';

// API Configuration
$debug      = false;      // Debug mode
$licenseKey = ''; // Your own unique license key, which can be purchased here (https://nextpost.tech/downloads/tiktok-rest-api/)

// Request parameters
$video_id  = '';    // TikTok video ID.

$tiktok = new \TikTokRESTAPI\TikTok($licenseKey, $debug);
try {
    // Validate the TikTok video ID
    // This is an example how to get $video_id from Console/Terminal
    if (empty($video_id)) {
        getVideoID:
        echo 'Enter the TikTok video ID:';
        $video_id = trim(fgets(STDIN));
    }

    getComments:
    if (isset($cursor)) {
        $resp = $tiktok->getCommentsByID($video_id, $cursor);
    } else {
        $resp = $tiktok->getCommentsByID($video_id);
    }

    if ($resp->isOk() && $resp->isTiktok()) {

        $comments = $resp->getTiktok()->getComments();

        if (count($comments) > 0) {
            $total = $resp->getTiktok()->getTotal();

            if (isset($cursor)) {
                echo sprintf('Loading next %s comments.', number_format(count($comments), 0 , '.' , ' ' )) . "\n";
            } else {
                echo sprintf('Video has %s comments.', number_format($total, 0 , '.' , ' ' )) . "\n";
                echo sprintf('Loading last %s comments.', number_format(count($comments), 0 , '.' , ' ' )) . "\n";
            }

            foreach ($comments as $key => $comment) {
                echo sprintf('Comment by @%s (%s)', $comment->getUser()->getUniqueId(), $comment->getUser()->getNickname()) . "\n";
                echo sprintf('- %s', $comment->getText()) . "\n";
            }

            $hasMore = $resp->getTiktok()->getHasMore();
            $cursor = $resp->getTiktok()->getCursor();

            if ($hasMore) {
                echo 'Do you want to load more comments?' . "\n";
                echo '1 - Yes' . "\n";
                echo '2 - No' . "\n";
                echo '3 - Check another video' . "\n";
                echo 'Your choice:';
                $choice = trim(fgets(STDIN));
                if ($choice == 1) {
                    goto getComments;
                } elseif ($choice == 3) {
                    goto getVideoID;
                }
            } else {
                echo "All video comments nas been loaded.\n";
            }
        } else {
            echo "Video has no comments.\n";
        }
    }
} catch (TikTokRESTAPI\Exception\BadRequestException $e) {
    // Request not performed because some data is missing or incorrect.
    echo sprintf('BadRequestException Catched: %s', $e->getMessage()) . "\n";
} catch (TikTokRESTAPI\Exception\ForbiddenException $e) {
    // Request failed due to invalid, expired, revoked license or access to API is restricted.
    echo sprintf('ForbiddenException Catched: %s', $e->getMessage()) . "\n";
} catch (TikTokRESTAPI\Exception\NotFoundException $e) {
    // Requested resource doesn't exist in TikTok.
    echo sprintf('NotFoundException Catched: %s', $e->getMessage()) . "\n";
} catch (TikTokRESTAPI\Exception\ProxyAuthException $e) {
    // Proxy auth data is missing or incorrect.
    echo sprintf('ProxyAuthException Catched: %s', $e->getMessage()) . "\n";
} catch (TikTokRESTAPI\Exception\TooManyRequestsException $e) {
    // Too many requests sent to TikTok.
    echo sprintf('TooManyRequestsException Catched: %s', $e->getMessage()) . "\n";
} catch (TikTokRESTAPI\Exception\NetworkException $e) {
    // Couldn't establish connection with REST API server
    echo sprintf('NetworkException Catched: %s', $e->getMessage()) . "\n";
} catch (TikTokRESTAPI\Exception\TikTokException $e) {
    // Invalid argument, missing or invalid data in request
    echo sprintf('TikTokException Catched: %s', $e->getMessage()) . "\n";
} catch (Exception $e) {
    echo sprintf('Exception Catched: %s', $e->getMessage()) . "\n";
    echo var_dump($e->getTrace());
}

