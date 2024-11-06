import { Card, Carousel } from '@/components/ui/apple-cards-carousel'
import { Button } from '@/components/ui/button'
import React from 'react'
import { SumoArena, SumoAssessment, SumoCompetitionRules, SumoRobotSpesification, SumoViolationsAndPenalties, Timeline } from './contents'

type SubCard = {
    title: string
    body: () => JSX.Element
}

type CardData = {
    category: string
    title: string
    src: string
    participant: string
    challengeType: string
    subCards?: SubCard[]
}

const data: CardData[] = [
    {
        category: 'Tingkat SMA/SMK/MA',
        title: 'Obstacle Avoidance Driving Game',
        src: '/categories/GZhQx-ka8AA9M4f.jpeg',
        participant: '1 team of 2 people',
        challengeType:
            'Make a robot that avoids collision with obstacles while moving from starting position to goal in an arena.',
        subCards: [
            {
                title: 'Timeline',
                body: () => {
                    return <Timeline />
                },
            },
        ],
    },
    {
        category: 'Tingkat Mahasiswa/Umum',
        title: 'Sumo Game',
        src: '/categories/GZhQx-ka8AA9M4f.jpeg',
        participant: '1 team of 5 people',
        challengeType: 'Each robot has to push the opponent out of the ring, in order to win the game.',
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
            {
                title: 'Arena',
                body: () => {
                    return <SumoArena />
                },
            },  
            {
                title: 'Competition Rules',
                body: () => {
                    return <SumoCompetitionRules />
                },
            },
            {
                title: 'Assessment',
                body: () => {
                    return <SumoAssessment />
                },
            },
            {
                title: 'Violations and Penalties',
                body: () => {
                    return <SumoViolationsAndPenalties />
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
        <div className="content w-full h-full py-20 bg-gradient-to-b from-slate-300 dark:from-slate-900">
            <h2 className="max-w-7xl text-2xl md:text-4xl font-bold text-neutral-800 dark:text-neutral-200 font-sans">
                Choose
            </h2>
            <h2 className="max-w-7xl text-2xl md:text-4xl font-bold text-neutral-800 dark:text-neutral-200 font-sans">
                Your Category
            </h2>
            <Carousel items={cards} />
        </div>
    )
}

const CreateContent: React.FC<CardData> = ({
    category,
    participant,
    challengeType,
    subCards,
}) => {
    return (
        <>
            <div className="bg-[#F5F5F7] dark:bg-neutral-800 p-8 md:p-14 rounded-3xl mb-4">
                <div className="flex mb-4">
                    <div className="min-w-32 dark:text-slate-100/50">
                        Participant
                    </div>
                    <div className="px-4">:</div>
                    <div>{participant}</div>
                </div>
                <div className="flex mb-4">
                    <div className="min-w-32 dark:text-slate-100/50">
                        Study Levels
                    </div>
                    <div className="px-4">:</div>
                    <div>{category}</div>
                </div>
                <div className="flex mb-4">
                    <div className="min-w-32 dark:text-slate-100/50">
                        Challenge Type
                    </div>
                    <div className="px-4">:</div>
                    <div>{challengeType}</div>
                </div>
                <div>
                    <Button asChild>
                        <a href="/panel/register">
                            Daftar Sekarang
                        </a>
                    </Button>
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