<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$to      = 'khmurtazin@yandex.ru';
$source  = isset($_POST['source_form']) ? $_POST['source_form'] : 'unknown';

if ($source === 'quiz') {
    $phone   = isset($_POST['phone'])   ? strip_tags(trim($_POST['phone']))   : '—';
    $task    = isset($_POST['task'])    ? strip_tags(trim($_POST['task']))    : '—';
    $niche   = isset($_POST['niche'])   ? strip_tags(trim($_POST['niche']))   : '—';
    $problem = isset($_POST['problem']) ? strip_tags(trim($_POST['problem'])) : '—';
    $budget  = isset($_POST['budget'])  ? strip_tags(trim($_POST['budget']))  : '—';

    $subject = '🎯 Новая заявка с квиза — ' . $phone;
    $body    = "Новая заявка с квиза на сайте murtazin-media.ru\n\n"
             . "Телефон:   $phone\n"
             . "Задача:    $task\n"
             . "Ниша:      $niche\n"
             . "Проблема:  $problem\n"
             . "Бюджет:    $budget\n"
             . "Время:     " . date('d.m.Y H:i') . "\n";
} else {
    $phone   = isset($_POST['phone'])          ? strip_tags(trim($_POST['phone']))          : '—';
    $method  = isset($_POST['contact_method']) ? strip_tags(trim($_POST['contact_method'])) : '—';

    $subject = '📞 Новая заявка на консультацию — ' . $phone;
    $body    = "Новая заявка на консультацию с сайта murtazin-media.ru\n\n"
             . "Телефон:         $phone\n"
             . "Способ связи:    $method\n"
             . "Время:           " . date('d.m.Y H:i') . "\n";
}

$headers  = "From: no-reply@murtazin-media.ru\r\n";
$headers .= "Reply-To: $to\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$sent = mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, $headers);

echo json_encode(['ok' => $sent]);
