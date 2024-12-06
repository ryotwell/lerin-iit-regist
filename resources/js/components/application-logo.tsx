const ApplicationLogo = () => {
    return (
        <div className="flex items-center">
            <img
                className="w-10 rounded-md"
                src="/ft-hamzanwadi.png"
                alt="Fakultas Teknik Universitas Hamzanwadi"
                loading="lazy"
            />
            <span className="mx-2 font-bold">X</span>
            <img
                className="w-28 rounded-md"
                src="/lerin-black.png"
                alt="Lerin NTB"
                loading="lazy"
            />
        </div>
    );
}

export default ApplicationLogo;