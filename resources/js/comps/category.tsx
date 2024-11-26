import { Card, Carousel } from '@/components/ui/apple-cards-carousel'
import { Button } from '@/components/ui/button'
import React from 'react'
import { AvoiderSpesification, SumoRobotSpesification, Timeline } from './contents'

type SubCard = {
    title: string
    body: () => JSX.Element
}

type CardData = {
    id: string
    category: string
    title: string
    src: string
    participant: string
    challengeType: string
    feeRegistration: string
    panduanDriveUrl?: string
    subCards?: SubCard[]
}

const data: CardData[] = [
    {
        id: "sumo",
        category: 'Tingkat Mahasiswa/Umum',
        title: 'Sumo Game',
        src: '/categories/3.png',
        participant: '1 tim terdiri dari 3 peserta (+ ketua tim)',
        challengeType: 'Setiap robot harus mendorong lawan keluar dari arena untuk memenangkan permainan.',
        feeRegistration: 'Rp. 75.000',
        panduanDriveUrl: 'https://drive.google.com/drive/folders/1hT8jyQm5kDMz3wsDgAYGfvFQ--Cg-e0K?usp=sharing',
        subCards: [
            {
                title: 'Timeline',
                body: () => {
                    return <Timeline />
                },
            },
            {
                title: 'Robot Spesification',
                body: () => {
                    return <SumoRobotSpesification />
                },
            },
            // {
            //     title: 'Arena',
            //     body: () => {
            //         return <SumoArena />
            //     },
            // },
            // {
            //     title: 'Competition Rules',
            //     body: () => {
            //         return <SumoCompetitionRules />
            //     },
            // },
            // {
            //     title: 'Assessment',
            //     body: () => {
            //         return <SumoAssessment />
            //     },
            // },
            // {
            //     title: 'Violations and Penalties',
            //     body: () => {
            //         return <SumoViolationsAndPenalties />
            //     },
            // },
        ],
    },
    {
        id: "avoider",
        category: 'Tingkat SMP/SMA/Sederajat',
        title: 'Avoider (obstacle)',
        src: '/categories/2.png',
        participant: '1 tim terdiri dari 2 peserta',
        challengeType: 'Buatlah robot yang menghindari tabrakan dengan rintangan saat bergerak dari posisi awal ke tujuan di dalam arena.',
        feeRegistration: 'Rp. 50.000',
        panduanDriveUrl: 'https://drive.google.com/drive/folders/1vk49ZgjI2iQDSj4692ekRkDodkZxnnlD?usp=sharing',
        subCards: [
            {
                title: 'Timeline',
                body: () => {
                    return <Timeline />
                },
            },
            {
                title: 'Robot Spesification',
                body: () => {
                    return <AvoiderSpesification />
                },
            },
        ],
    },
]

export const CategoryAppleCardsCarousel: React.FC = () => {
    const cards = data.map((card, index) => (
        <Card
            key={index}
            card={{ ...card, content: <CreateContent {...card} /> }}
            index={index}
        />
    ))

    return (
        <div className="content w-full h-full py-20 bg-gradient-to-b from-slate-300 dark:from-slate-900" id="categories">
            <div data-aos="fade-up">
                <h2 className="max-w-7xl text-2xl md:text-4xl font-bold text-neutral-800 dark:text-neutral-200 font-sans">
                    Choose
                </h2>
                <h2 className="max-w-7xl text-2xl md:text-4xl font-bold text-neutral-800 dark:text-neutral-200 font-sans">
                    Your Category
                </h2>
            </div>
            {/* <WordPullUp
                className="text-4xl font-bold tracking-[-0.02em] text-black dark:text-white md:text-7xl md:leading-[5rem]"
                words="Word Pull Up"
            /> */}
            <Carousel items={cards} />
        </div>
    )
}

const CreateContent: React.FC<CardData> = ({
    id,
    category,
    participant,
    challengeType,
    subCards,
    feeRegistration,
    panduanDriveUrl
}) => {
    return (
        <>
            <div className="bg-[#F5F5F7] dark:bg-neutral-800 p-8 md:p-14 rounded-3xl mb-4">
                <div className="flex mb-4">
                    <div className="min-w-32 dark:text-slate-100/50">
                        Peserta
                    </div>
                    <div className="px-4">:</div>
                    <div>{participant}</div>
                </div>
                <div className="flex mb-4">
                    <div className="min-w-32 dark:text-slate-100/50">
                        Tingkat Studi
                    </div>
                    <div className="px-4">:</div>
                    <div>{category}</div>
                </div>
                <div className="flex mb-4">
                    <div className="min-w-32 dark:text-slate-100/50">
                        Biaya Pendaftaran
                    </div>
                    <div className="px-4">:</div>
                    <div>{feeRegistration}</div>
                </div>
                <div className="flex mb-4">
                    <div className="min-w-32 dark:text-slate-100/50">
                        Jenis Tantangan
                    </div>
                    <div className="px-4">:</div>
                    <div>{challengeType}</div>
                </div>
                <div>
                    <Button asChild>
                        <a href={`/panel/register?robot_category=${id}`} className='mr-4'>
                            Daftar Sekarang
                        </a>
                    </Button>
                    {panduanDriveUrl ? (
                        <Button asChild>
                            <a href={panduanDriveUrl} target="_blank" rel="noreferrer">
                                Unduh Panduan
                            </a>
                        </Button>
                    ) : ''}
                </div>
            </div>
            {subCards?.map(({ body, title }, index) => {
                return (
                    <div
                        className="bg-[#F5F5F7] dark:bg-neutral-800 p-8 md:p-14 rounded-3xl mb-4"
                        key={index}
                    >
                        <h3 className="text-2xl mb-6 font-bold">{title}</h3>
                        {body()}
                    </div>
                )
            })}
        </>
    )
}