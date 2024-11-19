<?php
// Set the timezone
date_default_timezone_set('Asia/Jakarta');

// Get the current month and year
$month = date('m');
$year = date('Y');

// Create array of weekdays
$weekDays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Selalu pastikan tema cerah
        document.documentElement.classList.remove('dark');

        // Jika sebelumnya ada preferensi di localStorage, hapus agar tidak berpengaruh
        localStorage.removeItem('color-theme');
    </script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        #calendarGrid>div {
            aspect-ratio: 1 / 1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }

        /* Removed the background-color property from here */
        #calendarGrid>div:not(.text-xs) {
            border-radius: 0.25rem;
        }

        #calendarGrid>div.today {
            background-color: #3b82f6;
            color: white;
            font-weight: bold;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .chart-header select {
            padding: 2px 4px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 12px;
        }

        #donut-chart {
            flex: 0 0 0px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 6px;
        }

        .legend-color {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 6px;
        }

        .legend-text {
            font-size: 16px;
            color: #333;
            font-weight: 500;
        }
    </style>
</head>

<body class="bg-white">

    {{-- sidebar --}}
    @include('shared.component.sidebar')
    {{-- end sidebar --}}

    @yield('content')

    <script>
        function toggleText(card) {
            var textElement = card.querySelector('p');
            if (textElement.style.height === "0px") {
                textElement.style.height = textElement.scrollHeight + "px";
                textElement.style.overflow = "visible";
            } else {
                textElement.style.height = "0";
                textElement.style.overflow = "hidden";
            }
        }
    </script>
    <script>
        // JavaScript for dynamic calendar
        let currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();

        const calendarTitle = document.getElementById('calendarTitle');
        const calendarGrid = document.getElementById('calendarGrid');
        const prevMonthBtn = document.getElementById('prevMonth');
        const nextMonthBtn = document.getElementById('nextMonth');

        function generateCalendar(month, year) {
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const daysInMonth = lastDay.getDate();
            const startingDay = firstDay.getDay() || 7; // Convert Sunday (0) to 7

            calendarTitle.textContent = new Date(year, month).toLocaleDateString('default', {
                month: 'short',
                year: 'numeric'
            });

            // Clear previous days
            while (calendarGrid.children.length > 7) {
                calendarGrid.removeChild(calendarGrid.lastChild);
            }

            // Add empty cells for days before the first of the month
            for (let i = 1; i < startingDay; i++) {
                const emptyDay = document.createElement('div');
                calendarGrid.appendChild(emptyDay);
            }

            // Add days of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = document.createElement('div');
                dayElement.textContent = day;
                if (day === currentDate.getDate() && month === currentDate.getMonth() && year === currentDate
                    .getFullYear()) {
                    dayElement.classList.add('today');
                }
                calendarGrid.appendChild(dayElement);
            }

            // Add empty cells to complete the last row if necessary
            while (calendarGrid.children.length % 7 !== 0) {
                const emptyDay = document.createElement('div');
                calendarGrid.appendChild(emptyDay);
            }
        }

        prevMonthBtn.addEventListener('click', () => {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            generateCalendar(currentMonth, currentYear);
        });

        nextMonthBtn.addEventListener('click', () => {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            generateCalendar(currentMonth, currentYear);
        });

        // Initial calendar generation
        generateCalendar(currentMonth, currentYear);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.1/apexcharts.min.js"></script>
</body>

</html>
