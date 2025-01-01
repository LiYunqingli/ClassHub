const gameLog = document.getElementById('game-log');
const nextPhaseBtn = document.getElementById('next-phase-btn');

// 获取游戏状态
async function fetchGameState() {
  const response = await fetch('api/game.php?action=get_state');
  const data = await response.json();
  updateGameLog(data.message);
}

// 进入下一阶段
nextPhaseBtn.addEventListener('click', async () => {
  const response = await fetch('api/game.php?action=next_phase', { method: 'POST' });
  const data = await response.json();
  updateGameLog(data.message);
});

// 更新游戏日志
function updateGameLog(message) {
  const logEntry = document.createElement('p');
  logEntry.textContent = message;
  gameLog.appendChild(logEntry);
}

// 初始化
fetchGameState();
