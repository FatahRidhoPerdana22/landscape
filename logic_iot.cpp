#include <iostream>
using namespace std;

int main() {
    // Nilai dari sensorPh dan sensorLembab
    float minPh = 5, maxPh = 7, sensorPh;
    float minLembab = 40, maxLembab = 60, sensorLembab;

    cout << "Masukkan sensor Ph: ";
    cin >> sensorPh;
    cout << "Masukkan Sensor Lembab: ";
    cin >> sensorLembab;

    cout << "Kelembaban Tanah: " << sensorLembab << endl;
    cout << "PH Tanaman: " << sensorPh << endl;

    if (sensorLembab < minLembab) {
        if (sensorPh < minPh)
            cout << "Pump Hidup + kirim notifikasi lonceng PH rendah";
        else if (sensorPh > maxPh)
            cout << "Pump Hidup + kirim notifikasi lonceng PH tinggi";
        else
            cout << "Pump Hidup";
    } else if (sensorLembab <= maxLembab) {
        if (sensorPh < minPh)
            cout << "Pump Mati + kirim notifikasi lonceng PH rendah";
        else if (sensorPh > maxPh)
            cout << "Pump Mati + kirim notifikasi lonceng PH Tinggi";
        else
            cout << "Pump Mati";
    } else {
        if (sensorPh < minPh)
            cout << "Pump Mati + kirim notifikasi lonceng PH rendah & Kelembaban Tinggi";
        else if (sensorPh > maxPh)
            cout << "Pump Mati + kirim notifikasi lonceng PH tinggi & Kelembaban Tinggi";
        else
            cout << "Pump Mati + kirim notifikasi Kelembaban Tinggi";
    }

    return 0;
}
