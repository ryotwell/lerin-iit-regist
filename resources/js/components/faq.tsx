import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "@/components/ui/accordion"
import * as React from "react"

type FaqQuestionType = {
    title: string
    answer: string
}

const faqQuestions: FaqQuestionType[] = [
    {
        title: 'Berapa jumlah orang dalam satu tim?',
        answer: 'Anggota 2 orang, dan 1 orang sebagai penanggung jawab tim, jadi total 3 orang, berlaku di semua kategori.',
    },
    {
        title: 'Penanggung jawab tim diisi oleh siapa?',
        answer: 'Penanggung jawab tim bisa diisi oleh Mahasiswa/Siswa/Guru/Dosen',
    },
]

export function FaqSection() {
    const [questions, setQuestions] = React.useState<FaqQuestionType[]>(faqQuestions)

    return (
        <div className="content w-full h-full py-20 " id="categories">
            <div data-aos="fade-up">
                <h2 className="max-w-7xl text-2xl md:text-4xl font-bold text-neutral-800 dark:text-neutral-200 font-sans">
                    {`Pertanyaan Yang `}
                </h2>
                <h2 className="max-w-7xl text-2xl md:text-4xl font-bold text-neutral-800 dark:text-neutral-200 font-sans">
                    {`Sering Di Tanyakan (FAQ)`}
                </h2>
            </div>
            <Accordion type="single" collapsible className="w-full mt-6">
                {questions.map((question, index) => (
                    <AccordionItem key={index} value={`item-${index}`}>
                        <AccordionTrigger>{question.title}</AccordionTrigger>
                        <AccordionContent>{question.answer}</AccordionContent>
                    </AccordionItem>
                ))}
            </Accordion>
        </div>
    )
}