<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Carregando</title>
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body {
  height: 100vh;

}
.loading-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  backdrop-filter: blur(15px);
  background: rgba(0, 0, 0, 0.4);
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  opacity: 1;
  transition: opacity 0.4s ease;
}
.loading-overlay.hidden {
  opacity: 0;
  pointer-events: none;
}
.spinner {
  width: 50px;
  height: 50px;
  border: 4px solid rgba(76, 175, 80, 0.2);
  border-top: 4px solid #4caf50;
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
  margin-bottom: 20px;
}
.agro-icons {
  font-size: 24px;
  display: flex;
  gap: 15px;
}
.agro-icons span {
  animation: bounce 1.4s infinite;
}
.agro-icons span:nth-child(2) {
  animation-delay: 0.2s;
}
.agro-icons span:nth-child(3) {
  animation-delay: 0.4s;
}
@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}
@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-8px);
  }
  60% {
    transform: translateY(-4px);
  }
}
</style>
</head>
<body>
<div class="loading-overlay" id="loadingOverlay">
  <div class="spinner"></div>
  
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  setTimeout(function() {
    document.getElementById('loadingOverlay').classList.add('hidden');
  },300);
});
function showLoading() {
  const overlay = document.getElementById('loadingOverlay');
  overlay.classList.remove('hidden');
  setTimeout(function() {
    overlay.classList.add('hidden');
  }, 300);
}
</script>
</body>
</html>
