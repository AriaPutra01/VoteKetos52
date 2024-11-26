import { Link } from "react-router-dom";
import { Button } from "../components/ui/button";

export default function Welcome() {
  return (
    <section className="w-full min-h-screen flex justify-center items-center text-center">
      <div className="max-w-[40rem] grid grid-cols-1 gap-4">
        <div>
          <h1 className="text-5xl font-bold">Selamat Datang</h1>
          <h2 className="text-xl font-bold">
            di website <span className="">ESKUL52</span>
          </h2>
        </div>
        <p className="text-lg">
          Selamat datang di website pemilihan ketua OSIS! Pilih pemimpin yang
          akan membawa aspirasi dan perubahan positif bagi sekolah kita. Yuk,
          jadilah bagian dari masa depan yang lebih baik!
        </p>
        <span>
          <Button variant={"outline"} asChild>
            <Link to="/login-page">Masuk</Link>
          </Button>
        </span>
      </div>
    </section>
  );
}
