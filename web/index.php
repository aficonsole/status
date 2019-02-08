<?php
$auth = $_ENV['SHINKEN_AUTH'];
$url = 'https://shinken.mrphp.com.au/thruk/cgi-bin/status.cgi?view_mode=json';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $auth);
curl_setopt($ch, CURLOPT_USERAGENT, 'curl');
$services = json_decode(curl_exec($ch), true);
curl_close($ch);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta name="charset" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>System Status</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Droid+Sans+Mono' rel='stylesheet' type='text/css'>
    <link href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" rel="stylesheet">

    <style>
        html, body, body div, span, object, iframe, h1, h2, h3, h4, h5, h6, p,
        blockquote, pre, abbr, address, cite, code, del, dfn, em, img, ins, kbd, q, samp,
        small, strong, sub, sup, var, b, i, dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td,
        article, aside, figure, footer, header, hgroup, menu, nav, section, time, mark, audio, video {
            margin: 0;
            padding: 0;
            border: 0;
            outline: 0;
            font-size: 100%;
            letter-spacing: 0;
            vertical-align: baseline;
            background: transparent;
            font-weight: inherit
        }

        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        h2 {
            font-weight: bolder;
            text-align: center;
            margin-bottom: 10px;
        }

        article, aside, figure, footer, header, hgroup, nav, section {
            display: block
        }

        object, embed {
            max-width: 100%
        }

        ul {
            list-style: none
        }

        blockquote, q {
            quotes: none
        }

        b, strong {
            font-weight: bold
        }

        blockquote:before, blockquote:after, q:before, q:after {
            content: '';
            content: none
        }

        a {
            margin: 0;
            padding: 0;
            font-size: 100%;
            vertical-align: baseline;
            background: transparent
        }

        del {
            text-decoration: line-through
        }

        abbr[title], dfn[title] {
            border-bottom: 1px dotted #000;
            cursor: help
        }

        table {
            border-collapse: collapse;
            border-spacing: 0
        }

        mark {
            color: inherit
        }

        hr {
            display: block;
            height: 1px;
            border: 0;
            border-top: 1px solid #ccc;
            margin: 1em 0;
            padding: 0
        }

        input, select {
            vertical-align: middle
        }

        pre {
            white-space: pre;
            white-space: pre-wrap;
            white-space: pre-line;
            word-wrap: break-word
        }

        input[type="radio"] {
            vertical-align: text-bottom
        }

        input[type="checkbox"] {
            vertical-align: bottom;
            *vertical-align: baseline
        }

        .ie6 input {
            vertical-align: text-bottom
        }

        select, input, textarea {
            font: 99% sans-serif
        }

        table {
            font-size: inherit;
            font: 100%
        }

        a:hover, a:active {
            outline: none
        }

        small {
            font-size: 85%
        }

        strong, th {
            font-weight: bold
        }

        td, td img {
            vertical-align: top
        }

        sub, sup {
            font-size: 75%;
            line-height: 0;
            position: relative
        }

        sup {
            top: -0.5em
        }

        sub {
            bottom: -0.25em
        }

        pre, code, kbd, samp {
            font-family: monospace, sans-serif
        }

        .clickable, label, input[type=button], input[type=submit], button {
            cursor: pointer
        }

        button, input, select, textarea {
            margin: 0
        }

        button {
            width: auto;
            overflow: visible
        }

        .clearfix:before, .clearfix:after {
            content: "\0020";
            display: block;
            height: 0;
            overflow: hidden
        }

        .clearfix:after {
            clear: both
        }

        .clearfix {
            zoom: 1
        }

        select, input, textarea, a {
            outline: none
        }

        a {
            color: inherit
        }

        .ongoingIssues {
            margin-bottom: 15px
        }

        .issueBanner {
            background: #333;
            display: block;
            border-radius: 6px;
            text-decoration: none;
            padding: 13px 17px;
            color: #fff;
            margin-bottom: 15px
        }

        .issueBanner:last-child {
            margin-bottom: 0
        }

        .issueBanner--investigating {
            background: #d13943
        }

        .issueBanner--identified {
            background: #d13980
        }

        .issueBanner--monitoring {
            background: #399dd1
        }

        .issueBanner--maintenance {
            background: #fff7d6;
            color: #77745e
        }

        .issueBanner__state {
            float: right;
            font-weight: 600;
            font-size: 12px;
            margin-left: 15px
        }

        .issueBanner__time {
            font-size: 12px;
            opacity: 0.7
        }

        .maintenanceStatusTag {
            color: #aaa
        }

        .maintenanceStatusTag.maintenanceStatusTag--active {
            color: #6CBE07
        }

        .maintenanceStatusTag.maintenanceStatusTag--upcoming {
            color: #068FD6
        }

        .serviceGroup {
            margin-bottom: 25px
        }

        .serviceGroup__title {
            margin-bottom: 8px;
            font-size: 16px;
            color: #bfc8d0
        }

        .serviceList {
            border: 2px solid #bfc8d0;
            border-radius: 6px;
            margin-bottom: 10px
        }

        .serviceList__item {
            padding: 13px 15px;
            border-bottom: 1px solid #d7e2eb
        }

        .serviceList__item:after {
            content: " ";
            visibility: hidden;
            display: block;
            height: 0;
            clear: both
        }

        .serviceList__item:nth-child(even) {
            background: #f6fbff
        }

        .serviceList__item:last-child {
            border-bottom: 0;
            border-radius: 0 0 6px 6px
        }

        .serviceList__description {
            background: transparent url(/assets/default/question-b9b6b60e94188feeb1428c3873ad8a8ee4b8978a758f4907aa2f320d9d96276d.svg) 0 0/100% auto no-repeat;
            display: inline-block;
            height: 14px;
            margin-left: 5px;
            vertical-align: -1px;
            width: 14px
        }

        .serviceList__name {
            float: left
        }

        .serviceList__status {
            float: right
        }

        @media (max-width: 650px) {
            .serviceList__description {
                display: none
            }
        }

        @media (max-width: 470px) {
            .serviceList {
                font-size: 14px;
                border-width: 1px
            }
        }

        @media (max-width: 320px) {
            .serviceList__item {
                text-align: center
            }

            .serviceList__name {
                margin-bottom: 5px
            }

            .serviceList__name, .serviceList__status {
                float: none
            }
        }

        .siteFooter {
            border-top: 1px solid #efefef;
            padding: 30px 0 80px 0;
            overflow: hidden;
            font-size: 13px;
            margin-top: 50px
        }

        .siteFooter__nav {
            margin-bottom: 15px;
            float: left
        }

        .siteFooter__nav li {
            display: inline;
            margin-right: 25px
        }

        .siteFooter__nav li a {
            color: #999
        }

        .siteFooter__nav li:last-child {
            margin-right: 0
        }

        .siteFooter__copyright {
            float: right;
            color: #999
        }

        @media (max-width: 600px) {
            .siteFooter {
                text-align: center
            }

            .siteFooter__nav {
                float: none
            }

            .siteFooter__copyright {
                float: none;
                clear: left;
                margin-top: 15px;
                opacity: 0.5;
                font-size: 11px
            }
        }

        .siteHeader {
            text-align: center;
            background: #2B3034;
            padding: 60px 0 60px 0;
            position: relative;
            margin-bottom: 50px
        }

        .siteHeader.has-coverImage {
            padding: 260px 0 60px 0;
            background-size: cover
        }

        .siteHeader.has-coverImage .siteHeader__title {
            text-shadow: 0 0 6px rgba(0, 0, 0, 0.8)
        }

        .siteHeader.has-coverImage .siteHeader__subTitle {
            color: #fff;
            text-shadow: 0 0 6px black
        }

        .siteHeader__title {
            font-size: 55px;
            letter-spacing: -0.05em;
            font-weight: 700;
            color: #fff;
            margin-bottom: 15px
        }

        .siteHeader__subTitle {
            font-size: 16px;
            width: 80%;
            margin: auto;
            line-height: 24px;
            color: #7e8890
        }

        @media (max-width: 750px) {
            .siteHeader__title {
                font-size: 6.0vw
            }
        }

        @media (max-width: 600px) {
            .siteHeader {
                padding: 85px 0 30px 0;
                margin-bottom: 25px
            }

            .siteHeader.has-coverImage {
                padding: 100px 0 40px 0
            }

            .siteHeader__subTitle {
                font-size: 14px;
                line-height: 20px
            }
        }

        @media (max-width: 470px) {
            .siteHeader__subTitle {
                font-size: 13px;
                line-height: 18px
            }
        }

        body {
            font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 16px;
            -webkit-text-size-adjust: none;
            text-size-adjust: none
        }

        .container {
            max-width: 700px;
            margin: 0 auto
        }

        @media (max-width: 750px) {
            .container {
                padding: 0 25px
            }
        }
    </style>

</head>
<body>


<header class="siteHeader">
    <div class="container">
        <h1 class="siteHeader__title">Service Status</h1>
    </div>
</header>

<div class="container">


    <?php
    $ongoingIssues = [];
    //$ongoingIssues[] = [
    //    'tag' => 'monitoring',
    //    'state' => 'Monitoring',
    //    'name' => 'Network Connectivity Issues',
    //    'last_updated' => '2018-10-17T01:00:06+01:00',
    //];
    //$ongoingIssues[] = [
    //    'tag' => 'maintenance',
    //    'state' => 'Monitoring',
    //    'name' => 'Network Connectivity Issues',
    //    'last_updated' => '2018-10-17T01:00:06+01:00',
    //];
    if ($ongoingIssues) {
        ?>
        <section class="ongoingIssues">
            <?php
            foreach ($ongoingIssues as $ongoingIssue) {
                ?>
                <div class="issueBanner issueBanner--<?= $ongoingIssue['tag'] ?>">
                    <p class="issueBanner__state"><?= $ongoingIssue['state'] ?></p>
                    <h2><?= $ongoingIssue['name'] ?></h2>
                    <p class="issueBanner__time">last updated
                        <time datetime="<?= $ongoingIssue['last_updated'] ?>"><?= $ongoingIssue['last_updated'] ?></time>
                    </p>
                </div>
                <?php
            }
            ?>
        </section>
        <?php
    }
    ?>

    <?php
    $groupMap = [
        'afi.ink db' => 'Main Services',
        'afi.ink www' => 'Main Services',
        'afi.ink host1' => '_Failover Services',
        'afi.ink v3' => '__Version3 (historical)',
    ];

    $groups = [];
    foreach ($services as $service) {
        $alias = $groupMap[$service['host_alias']] ?? $service['host_alias'];
        $groups[$alias][] = $service;
    }
    ksort($groups);
    foreach ($groups as $alias => $group) {
        ?>
        <h2><?= str_replace('_', '', $alias) ?></h2>
        <section class="serviceGroup">
            <ul class="serviceList serviceGroup__list">
                <?php
                foreach ($group as $service) {
                    if ($service['state'] == 0) {
                        $tag = 'ok';
                        $state = 'OK';
                        $color = '#2FCC66';
                    } elseif ($service['state'] == 1) {
                        $tag = 'minor';
                        $state = 'WARNING';
                        $color = '#E67E22';
                    } elseif ($service['state'] == 2) {
                        $tag = 'major';
                        $state = 'CRITICAL';
                        $color = '#E74C3C';
                    } else {
                        $tag = 'maintenance';
                        $state = 'UNKNOWN';
                        $color = '#AAAAAA';
                    }
                    ?>
                    <li class="serviceList__item">
                        <p class="serviceList__status">
                            <span class="serviceStatusTag serviceStatusTag--<?= $tag ?>" style="color:<?= $color ?>"><?= $state ?></span>
                        </p>
                        <p class="serviceList__name">
                            <?= $service['display_name'] ?>
                        </p>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </section>
        <?php
    }
    ?>
</div>

<footer class="siteFooter">
    <div class="container">
        <ul class="siteFooter__nav">
            <li><a href="https://afi.ink">AFI Console</a></li>
        </ul>
        <p class="siteFooter__copyright">
            &copy; <?= date('Y') ?>
            <a href="https://www.afibranding.com.au">AFI Branding</a>
        </p>
    </div>
</footer>

</body>
</html>
