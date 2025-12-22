<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalBookings = Booking::count();
        $totalRevenue = Booking::where('status', 'completed')->sum('total_price');
        $totalParticipants = Booking::sum('participants');

        // Hitung jumlah user unik yang melakukan booking
        $totalUsersWithBooking = Booking::distinct('user_id')->count('user_id');
        $totalUsers = User::count();

        $conversionRate = $totalUsers > 0 ? round(($totalUsersWithBooking / $totalUsers) * 100, 2) : 0;


        // Laporan booking terbaru
        $recentBookings = Booking::with('user', 'tour')
            ->where('status', 'completed')
            ->latest()
            ->take(10)
            ->get();

        // Statistik bulanan (Jan–Des tahun ini)
        $monthlyStats = [];
        for ($month = 1; $month <= 12; $month++) {
            $bookings = Booking::whereYear('created_at', now()->year)
                ->whereMonth('created_at', $month)
                ->count();

            $customers = Booking::whereYear('created_at', now()->year)
                ->whereMonth('created_at', $month)
                ->distinct('user_id')
                ->count('user_id');

            $revenue = Booking::where('status', 'completed')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', $month)
                ->sum('total_price');

            $monthlyStats[] = [
                'month' => date('M', mktime(0, 0, 0, $month, 1)),
                'bookings' => $bookings,
                'customers' => $customers,
                'revenue' => $revenue,
            ];
        }

        return view('admin.reports.index', compact(
            'totalBookings',
            'totalRevenue',
            'totalParticipants',
            'conversionRate',
            'recentBookings',
            'monthlyStats'
        ));
    }

    public function exportExcel()
    {
        return response()->streamDownload(function () {
            echo "Export laporan booking ke format Excel masih dalam tahap pengembangan.\n";
            echo "Silakan gunakan fitur ini pada versi selanjutnya.";
        }, 'laporan-booking.xlsx', [
            'Content-Type' => 'text/plain',
        ]);
    }

    public function exportPdf()
    {
        return response()->streamDownload(function () {
            echo "%PDF-1.4\n";
            echo "1 0 obj<<>>endobj\n";
            echo "Export laporan booking ke format PDF masih dalam tahap pengembangan.\n";
            echo "Fitur ini akan tersedia pada update berikutnya.";
            echo "trailer<<>>\n";
            echo "%%EOF";
        }, 'laporan-booking.pdf', [
            'Content-Type' => 'application/pdf',
        ]);
    }

}