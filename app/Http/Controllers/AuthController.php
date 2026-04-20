public function register(Request $request)
{

    $request->validate([
        'nama'     => 'required|string|max:255',
        'alamat'   => 'required|string',
        'no_ktp'   => 'required|numeric|unique:users,no_ktp',
        'no_hp'    => 'required|numeric',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6'
    ]);

    $lastPasien = User::where('role', 'pasien')->orderBy('id', 'desc')->first();
    $lastId = $lastPasien ? $lastPasien->id + 1 : 1;
    $no_rm = date('Ym') . '-' . str_pad($lastId, 3, '0', STR_PAD_LEFT);

    User::create([
        'nama'     => $request->nama,
        'alamat'   => $request->alamat,
        'no_ktp'   => $request->no_ktp,
        'no_hp'    => $request->no_hp,
        'no_rm'    => $no_rm,
        'role'     => 'pasien',
        'email'    => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
}