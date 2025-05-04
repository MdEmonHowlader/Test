import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Welcome">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]">
                <header className="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl">
                    <nav className="flex items-center justify-end gap-4">
                        {auth.user ? (
                            <Link
                                href={route('dashboard')}
                               
                            >
                                
                            </Link>
                        ) : (
                            <>
                                {/* <Link
                                    href={route('login')}
                                   
                                >
                                    Log in
                                </Link>
                                <Link
                                    href={route('register')}
                                    
                                >
                                    Register
                                </Link> */}
                            </>
                        )}
                    </nav>
                </header>
                <div className="flex flex-col items-center justify-center gap-4">
                    <h1 className="text-4xl font-bold leading-tight text-[#1b1b18] dark:text-[#EDEDEC]">
                        Welcome to <span className="text-[#FF3D00]">Laravel</span> + <span className="text-[#FF3D00]">React</span> Starter Kit
                    </h1>
                    <p className="text-lg text-[#1b1b18] dark:text-[#EDEDEC]">
                        A simple and elegant starter kit for building modern web applications with Laravel and React.
                    </p>
                </div>
                <div className="mt-6 flex w-full max-w-[335px] flex-col gap-4 lg:max-w-4xl">
                    <Link
                        href={route('dashboard')}
                        className="inline-block rounded-sm border border-[#19140035] bg-[#FF3D00] px-5 py-1.5 text-center text-sm font-semibold leading-normal text-white hover:border-[#1915014a] dark:border-[#3E3E3A] dark:bg-[#FF3D00] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Get Started
                    </Link>
                  </div>  
    
                        
            </div>
        </>
    );
}
