import LoginForm from "@/components/LoginForm";

export default function Login() {
  return (
    <section className="w-full h-screen flex gap-[4rem] justify-center items-center p-[3rem]">
      {/* section kiri */}
      <div className="grid grid-cols-1 grid-rows-[auto_1fr_1fr] w-full h-full">
        {/* section logo */}
        <div className="flex gap-[1rem] items-center mb-[2rem]">
          <span className="block w-fit rounded-full p-2 bg-blue-950">
            <img
              className="object-cover object-center size-[3rem]"
              src="/assets/pi.png"
              alt="pi"
            />
          </span>
          <h1 className="uppercase text-lg font-bold">
            smk prakarya internasional
          </h1>
        </div>
        {/* end section logo */}
        {/* section form */}
        <div className="">
          <div className="mb-[1rem]">
            <h1 className="font-bold text-4xl">Selamat Datang</h1>
            <p className="text-xl">Mohon masukan detail login anda!</p>
          </div>
          <div className="">
            <LoginForm />
          </div>
        </div>
        {/* end section form */}
        {/* section footer */}
        <div className="h-full flex justify-center items-end">
          <h1 className="whitespace-nowrap">
            Web ini di dibuat oleh Aria & Robi
          </h1>
        </div>
        {/* end section footer */}
      </div>
      {/* end section kiri */}
      {/* section kanan */}
      <div className="w-full h-full">
        {/* Foto */}
        <div className="w-full h-full bg-gray-200 rounded-lg flex justify-center items-center">
          <img src="" alt="FOTO" />
        </div>
        {/* End Foto */}
      </div>
      {/* end section kanan */}
    </section>
  );
}
