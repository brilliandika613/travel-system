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
        $conversionRate = $totalBookings > 0 ? round(($totalBookings / User::count()) * 100, 2) : 0;

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
        // Akan diisi nanti dengan library seperti PhpSpreadsheet
        return response()->streamDownload(function () {
            echo "Fitur export Excel akan diaktifkan segera.";
        }, 'laporan-booking.xlsx');
    }

    public function exportPdf()
    {
        // Akan diisi nanti dengan library seperti DomPDF
        return response()->streamDownload(function () {
            echo "Fitur export PDF akan diaktifkan segera.";
        }, 'laporan-booking.pdf');
    }
}