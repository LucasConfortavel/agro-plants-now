const themeOptions = document.querySelectorAll('.theme-option');
        const body = document.body;

        const savedTheme = localStorage.getItem('theme') || 'dark';
        applyTheme(savedTheme);

        themeOptions.forEach(option => {
            if (option.dataset.theme === savedTheme) {
                option.classList.add('active');
            } else {
                option.classList.remove('active');
            }
        });

        themeOptions.forEach(option => {
            option.addEventListener('click', () => {
                const selectedTheme = option.dataset.theme;
                
                body.classList.add('theme-transitioning');
                
                setTimeout(() => {
                    applyTheme(selectedTheme);
                    body.classList.remove('theme-transitioning');
                }, 50);

                themeOptions.forEach(opt => opt.classList.remove('active'));
                option.classList.add('active');

                localStorage.setItem('theme', selectedTheme);
                
                showToast(`Tema ${getThemeName(selectedTheme)} aplicado com sucesso!`, 'success');
            });
        });

        function applyTheme(theme) {
            body.classList.remove('dark-theme', 'light-theme');
            
            if (theme === 'dark') {
                body.classList.add('dark-theme');
            } else if (theme === 'light') {
                body.classList.add('light-theme');
            }
        }

        function getThemeName(theme) {
            switch(theme) {
                case 'dark': return 'Escuro';
                case 'light': return 'Claro';
                default: return 'Escuro';
            }
        }
        
        // Função para mudar para aba de foto
        function switchToPhotoTab() {
            const photoTab = document.querySelector('.tab-btn[data-tab="photo"]');
            if (photoTab) {
                photoTab.click();
            }
        }
        
        function showToast(message, type = 'info') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.textContent = message;
            container.appendChild(toast);

            setTimeout(() => toast.classList.add('show'), 100);
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
        // Funcionalidade de upload de foto com drag-and-drop e preview
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('foto');
        const previewArea = document.getElementById('previewArea');
        const previewImg = document.getElementById('previewImg');
        const fileInfo = document.getElementById('fileInfo');
        const btnUpload = document.getElementById('btnUpload');

        // Prevenir comportamento padrão
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        // Highlight ao arrastar
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, () => {
                uploadArea.classList.add('drag-over');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, () => {
                uploadArea.classList.remove('drag-over');
            }, false);
        });

        // Handle drop
        uploadArea.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            // Transferir arquivo para o input
            const dataTransfer = new DataTransfer();
            for (let i = 0; i < files.length; i++) {
                dataTransfer.items.add(files[i]);
            }
            fileInput.files = dataTransfer.files;
            
            handleFiles(files);
        }, false);

        // Handle file input change
        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        function handleFiles(files) {
            if (files.length === 0) return;
            
            const file = files[0];
            
            // Validar tipo de arquivo
            if (!file.type.startsWith('image/')) {
                showToast('Por favor, selecione apenas arquivos de imagem', 'error');
                return;
            }
            
            // Validar tamanho (5MB)
            if (file.size > 5 * 1024 * 1024) {
                showToast('A imagem deve ter no máximo 5MB', 'error');
                return;
            }
            
            // Mostrar preview
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImg.src = e.target.result;
                uploadArea.style.display = 'none';
                previewArea.style.display = 'block';
                
                // Mostrar informações do arquivo
                const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                fileInfo.innerHTML = `
                    <strong>${file.name}</strong><br>
                    Tamanho: ${sizeInMB} MB | Tipo: ${file.type}
                `;
                
                btnUpload.disabled = false;
            };
            reader.readAsDataURL(file);
        }

        function removePreview() {
            uploadArea.style.display = 'block';
            previewArea.style.display = 'none';
            fileInput.value = '';
            btnUpload.disabled = true;
        }