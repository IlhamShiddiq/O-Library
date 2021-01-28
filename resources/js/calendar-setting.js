// import $ from "jquery";

// let cal = $('#calendar');
// let calendar = new Calendar(cal);

// let transactionGraphic = document.getElementById('transaction');
// let adminGraphic = document.getElementById('admin');
// let memberGraphic = document.getElementById('member');

// let TransactionGraphic = new Chart(transactionGraphic, {
//     type: 'bar',
//     data: {
//         labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at'],
//         datasets: [{
//             label: 'Jumlah transaksi',
//             data: [{{$monday_transaction}}, {{$tuesday_transaction}}, {{$wednesday_transaction}}, {{$thursday_transaction}}, {{$friday_transaction}}],
//             backgroundColor: [
//                 'rgba(255, 99, 132)',
//                 'rgba(54, 162, 235)',
//                 'rgba(255, 206, 86)',
//                 'rgba(75, 192, 192)',
//                 'rgba(153, 102, 255)',
//             ],
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: true
//                 }
//             }]
//         },
//         legend: {
//             display: false
//         },
//         title: {
//             display: true,
//             text: 'Jumlah peminjaman minggu ini'
//         }
//     }
// });

// let AdminGraphic = new Chart(adminGraphic, {
//     type: 'doughnut',
//     data: {
//         labels: ['Admin', 'Pustakawan'],
//         datasets: [{
//             label: 'Jumlah',
//             data: [<?php echo $sum_adms; ?>, <?php echo $sum_libs; ?>],
//             backgroundColor: [
//                 'rgb(48, 141, 56)',
//                 'rgb(79, 207, 90)',
//             ],
//         }]
//     },
//     options: {
//         legend: {
//             display: false
//         },
//         title: {
//             display: true,
//             text: 'Jumlah pustakawan'
//         },
//         layout: {
//             padding: {
//                 left: 0,
//                 right: 0,
//                 top: 20,
//                 bottom: 20
//             }
//         }
//     }
// });

// let MemberGraphic = new Chart(memberGraphic, {
//     type: 'doughnut',
//     data: {
//         labels: ['Guru', 'Siswa'],
//         datasets: [{
//             label: 'Jumlah',
//             data: [<?php echo $sum_teacher; ?>, <?php echo $sum_student; ?>],
//             backgroundColor: [
//                 'rgb(79, 207, 90)',
//                 'rgb(48, 141, 56)',
//             ],
//         }]
//     },
//     options: {
//         legend: {
//             display: false
//         },
//         title: {
//             display: true,
//             text: 'Jumlah anggota'
//         },
//         layout: {
//             padding: {
//                 left: 0,
//                 right: 0,
//                 top: 20,
//                 bottom: 20
//             }
//         }
//     }
// });