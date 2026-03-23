                </div>
            </main>

            {{-- copyright --}}
            {{-- <footer class="text-center mt-2 p-5 text-[90%]">
                &copy; Naufal Zuhdi 2025. <b class="font-bold">Perpustakaan Daerah.</b> All Rights Reserved.
            </footer> --}}

        </div>
    </div>

    {{-- notifikasi --}}
    @include('sweetalert::alert')

    {{-- JS Dark Mode --}}
    <script>
        const html = document.documentElement;
        const darkBtn = document.getElementById('darkModeBtn');
        const darkIcon = document.getElementById('darkModeIcon');
        const darkText = document.getElementById('darkModeText');

        // INIT dari localStorage
        if (localStorage.getItem('theme') === 'dark') {
            html.classList.add('dark');
            darkIcon.textContent = 'light_mode';
            darkText.textContent = 'Light Mode';
        }

        darkBtn.addEventListener('click', () => {
            html.classList.toggle('dark');

            if (html.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
                darkIcon.textContent = 'light_mode';
                darkText.textContent = 'Light Mode';
            } else {
                localStorage.setItem('theme', 'light');
                darkIcon.textContent = 'dark_mode';
                darkText.textContent = 'Dark Mode';
            }
        });
    </script>

    
</body>
</html>