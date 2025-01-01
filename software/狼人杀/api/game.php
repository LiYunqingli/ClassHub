<?php
require 'utils.php';

$action = $_GET['action'] ?? null;
$gameState = loadGameState();

switch ($action) {
    case 'get_state':
        respondWithState($gameState);
        break;

    case 'next_phase':
        $gameState = advanceGamePhase($gameState);
        saveGameState($gameState);
        respondWithState($gameState);
        break;

    default:
        echo json_encode(['error' => 'Invalid action']);
}

// 加载游戏状态
function loadGameState() {
    $file = '../data/game_state.json';
    return json_decode(file_get_contents($file), true);
}

// 保存游戏状态
function saveGameState($state) {
    $file = '../data/game_state.json';
    file_put_contents($file, json_encode($state));
}

// 更新游戏状态
function advanceGamePhase($state) {
    $phase = $state['phase'];
    switch ($phase) {
        case 'night_start':
            $state['phase'] = 'wolf_action';
            $state['message'] = '狼人请睁眼...';
            break;
        case 'wolf_action':
            $state['phase'] = 'seer_action';
            $state['message'] = '预言家请睁眼...';
            break;
        case 'seer_action':
            $state['phase'] = 'witch_action';
            $state['message'] = '女巫请睁眼...';
            break;
        case 'witch_action':
            $state['phase'] = 'day_start';
            $state['message'] = '天亮了，玩家请睁眼。';
            break;
        case 'day_start':
            $state['phase'] = 'discussion';
            $state['message'] = '自由发言开始...';
            break;
        case 'discussion':
            $state['phase'] = 'vote';
            $state['message'] = '请进行投票。';
            break;
        case 'vote':
            $state['phase'] = 'execution';
            $state['message'] = '投票结果揭晓，被处决的是...';
            break;
        case 'execution':
            $state['phase'] = 'night_start';
            $state['message'] = '天黑了，请闭眼。';
            break;
    }
    return $state;
}

// 响应游戏状态
function respondWithState($state) {
    echo json_encode([
        'phase' => $state['phase'],
        'message' => $state['message']
    ]);
}
