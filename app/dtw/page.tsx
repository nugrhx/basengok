import Card from "@/components/home/card";
import ComponentGrid from "@/components/home/component-grid";
import WebVitals from "@/components/home/web-vitals";
import { DEPLOY_URL } from "@/lib/constants";
import { ChevronRight } from "lucide-react";
import Image from "next/image";

export default async function Home() {

  return (
    <>
        <div className="z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div className="mx-auto max-w-2xl max-w-none">

            <div className="space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:space-y-0 no-scrollbar overflow-y-auto">

              <div className="group relative">
                <div className="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
                  <Image
                    src="/landing.jpg" 
                    width={1080}
                    height={1080}
                    alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug." 
                    className="h-full w-full object-cover object-center"
                  />
                </div>
                <h3 className="mt-6 text-sm text-gray-500">
                  <a href="#">
                    <span className="absolute inset-0"></span>
                    Desk and Office
                  </a>
                </h3>
                <p className="text-base font-semibold text-gray-900">Work from home accessories</p>
              </div>
              <div className="group relative">
                <div className="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
                  <Image
                    src="/landing.jpg" 
                    width={1080}
                    height={1080}
                    alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug." 
                    className="h-full w-full object-cover object-center"
                  />
                </div>
                <h3 className="mt-6 text-sm text-gray-500">
                  <a href="#">
                    <span className="absolute inset-0"></span>
                    Desk and Office
                  </a>
                </h3>
                <p className="text-base font-semibold text-gray-900">Work from home accessories</p>
              </div>
              <div className="group relative">
                <div className="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
                  <Image
                    src="/landing.jpg" 
                    width={1080}
                    height={1080}
                    alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug." 
                    className="h-full w-full object-cover object-center"
                  />
                </div>
                <h3 className="mt-6 text-sm text-gray-500">
                  <a href="#">
                    <span className="absolute inset-0"></span>
                    Desk and Office
                  </a>
                </h3>
                <p className="text-base font-semibold text-gray-900">Work from home accessories</p>
              </div>
              <div className="group relative">
                <div className="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
                  <Image
                    src="/landing.jpg" 
                    width={1080}
                    height={1080}
                    alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug." 
                    className="h-full w-full object-cover object-center"
                  />
                </div>
                <h3 className="mt-6 text-sm text-gray-500">
                  <a href="#">
                    <span className="absolute inset-0"></span>
                    Desk and Office
                  </a>
                </h3>
                <p className="text-base font-semibold text-gray-900">Work from home accessories</p>
              </div>
              <div className="group relative">
                <div className="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
                  <Image
                    src="/landing.jpg" 
                    width={1080}
                    height={1080}
                    alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug." 
                    className="h-full w-full object-cover object-center"
                  />
                </div>
                <h3 className="mt-6 text-sm text-gray-500">
                  <a href="#">
                    <span className="absolute inset-0"></span>
                    Desk and Office
                  </a>
                </h3>
                <p className="text-base font-semibold text-gray-900">Work from home accessories</p>
              </div>
              <div className="group relative">
                <div className="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
                  <Image
                    src="/landing.jpg" 
                    width={1080}
                    height={1080}
                    alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug." 
                    className="h-full w-full object-cover object-center"
                  />
                </div>
                <h3 className="mt-6 text-sm text-gray-500">
                  <a href="#">
                    <span className="absolute inset-0"></span>
                    Desk and Office
                  </a>
                </h3>
                <p className="text-base font-semibold text-gray-900">Work from home accessories</p>
              </div>
              <div className="group relative">
                <div className="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
                  <Image
                    src="/landing.jpg" 
                    width={1080}
                    height={1080}
                    alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug." 
                    className="h-full w-full object-cover object-center"
                  />
                </div>
                <h3 className="mt-6 text-sm text-gray-500">
                  <a href="#">
                    <span className="absolute inset-0"></span>
                    Desk and Office
                  </a>
                </h3>
                <p className="text-base font-semibold text-gray-900">Work from home accessories</p>
              </div>
              <div className="group relative">
                <div className="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
                  <Image
                    src="/landing.jpg" 
                    width={1080}
                    height={1080}
                    alt="Wood table with porcelain mug, leather journal, brass pen, leather key ring, and a houseplant." 
                    className="h-full w-full object-cover object-center"
                    />
                </div>
                <h3 className="mt-6 text-sm text-gray-500">
                  <a href="#">
                    <span className="absolute inset-0"></span>
                    Self-Improvement
                  </a>
                </h3>
                <p className="text-base font-semibold text-gray-900">Journals and note-taking</p>
              </div>
              <div className="group relative">
                <div className="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
                  <Image
                    src="/landing.jpg" 
                    width={1080}
                    height={1080}
                    alt="Collection of four insulated travel bottles on wooden shelf." 
                    className="h-full w-full object-cover object-center"
                   />
                </div>
                <h3 className="mt-6 text-sm text-gray-500">
                  <a href="#">
                    <span className="absolute inset-0"></span>
                    Travel
                  </a>
                </h3>
                <p className="text-base font-semibold text-gray-900">Daily commute essentials</p>
              </div>
            </div>
          </div>
        </div>

    </>
  );
}
