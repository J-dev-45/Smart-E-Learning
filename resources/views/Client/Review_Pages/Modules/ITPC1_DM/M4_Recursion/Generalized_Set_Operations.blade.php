<div class="mt-10" id="topic-generalized-set-operations">

    <h2 class="text-2xl font-bold">
        2. Generalized Set Operations
    </h2>

    <div class="w-full h-[1px] flex items-center justify-center pt-[10px]">
        <div class="sharedLine w-full h-[1px]"></div>
    </div>

    <p class="text-md sharedTXTMuted px-3 mt-4 leading-relaxed">
        Generalized set operations extend ordinary set operations to work
        with a collection or family of sets rather than only two sets at a
        time. The two main generalized operations are the union and
        intersection of a family of sets.
    </p>

    <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
        These operations are useful when a problem involves several groups
        of objects, such as users belonging to different teams, records
        matching different categories, or elements shared by multiple sets.
    </p>

    <h3 class="text-xl font-bold mt-6">
        Generalized Union
    </h3>

    <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
        The generalized union of a family of sets contains every element
        that belongs to at least one set in that family. If the family is
        written as A₁, A₂, ..., Aₙ, its union is represented by
        ⋃ᵢ₌₁ⁿ Aᵢ.
    </p>

    <div class="sharedSurfaceDeepBG border sharedBorder rounded-xl p-5 mt-4">
        <h4 class="font-bold text-lg">
            Example
        </h4>

        <p class="sharedTXT mt-3">A₁ = {1, 2, 3}</p>
        <p class="sharedTXT mt-2">A₂ = {3, 4}</p>
        <p class="sharedTXT mt-2">A₃ = {4, 5, 6}</p>

        <div class="mt-4 border-t sharedBorder pt-3">
            <p class="sharedTXTMuted">
                The generalized union includes every distinct element found
                in at least one of the sets.
            </p>
            <p class="sharedTXT mt-3">
                A₁ ∪ A₂ ∪ A₃ = {1, 2, 3, 4, 5, 6}
            </p>
        </div>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Generalized Intersection
    </h3>

    <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
        The generalized intersection of a family of sets contains only
        elements that belong to every set in that family. It is represented
        by ⋂ᵢ₌₁ⁿ Aᵢ.
    </p>

    <div class="sharedSurfaceDeepBG border sharedBorder rounded-xl p-5 mt-4">
        <h4 class="font-bold text-lg">
            Example
        </h4>

        <p class="sharedTXT mt-3">A₁ = {1, 2, 3, 4}</p>
        <p class="sharedTXT mt-2">A₂ = {2, 3, 4, 5}</p>
        <p class="sharedTXT mt-2">A₃ = {0, 2, 3, 6}</p>

        <div class="mt-4 border-t sharedBorder pt-3">
            <p class="sharedTXTMuted">
                The elements 2 and 3 are present in all three sets.
            </p>
            <p class="sharedTXT mt-3">
                A₁ ∩ A₂ ∩ A₃ = {2, 3}
            </p>
        </div>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Union and Intersection Compared
    </h3>

    <div class="overflow-x-auto mt-4">
        <table class="w-full border-collapse">
            <thead>
                <tr class="sharedSurfaceBG">
                    <th class="border sharedBorder p-3 text-left">Operation</th>
                    <th class="border sharedBorder p-3 text-left">Includes an element when...</th>
                    <th class="border sharedBorder p-3 text-left">Symbol</th>
                </tr>
            </thead>
            <tbody class="sharedTXTMuted">
                <tr>
                    <td class="border sharedBorder p-3 sharedTXT">Generalized union</td>
                    <td class="border sharedBorder p-3">It belongs to at least one set in the family.</td>
                    <td class="border sharedBorder p-3 sharedTXT">⋃</td>
                </tr>
                <tr>
                    <td class="border sharedBorder p-3 sharedTXT">Generalized intersection</td>
                    <td class="border sharedBorder p-3">It belongs to every set in the family.</td>
                    <td class="border sharedBorder p-3 sharedTXT">⋂</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Indexing a Family of Sets
    </h3>

    <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
        A family of sets can be indexed to show which set is being considered.
        For example, A₁, A₂, A₃, ..., Aₙ is a finite family, where each
        subscript identifies one set. An index can also represent a larger
        or infinite family when the context defines the index values.
    </p>

    <div class="sharedSurfaceDeepBG border sharedBorder rounded-xl p-5 mt-4">
        <h4 class="font-bold text-lg">
            Example: Sets of Courses
        </h4>

        <p class="sharedTXTMuted mt-3">
            Suppose each set represents students enrolled in a course.
        </p>

        <p class="sharedTXT mt-3">A₁ = {Ana, Ben, Carlo}</p>
        <p class="sharedTXT mt-2">A₂ = {Ben, Dana}</p>
        <p class="sharedTXT mt-2">A₃ = {Carlo, Dana, Eva}</p>

        <div class="mt-4 border-t sharedBorder pt-3 space-y-2 sharedTXTMuted">
            <p>
                <span class="sharedTXT">Generalized union:</span>
                {Ana, Ben, Carlo, Dana, Eva}
            </p>
            <p>
                <span class="sharedTXT">Generalized intersection:</span>
                ∅, because no student appears in all three sets.
            </p>
        </div>
    </div>

    <h3 class="text-xl font-bold mt-6">
        Applications in Information Technology
    </h3>

    <p class="text-md sharedTXTMuted px-3 mt-3 leading-relaxed">
        Generalized set operations can model collections of data across
        multiple categories. A generalized union can combine the members of
        several groups, while a generalized intersection can identify records
        that satisfy every group condition.
    </p>

    <div class="sharedSurfaceDeepBG border sharedBorder rounded-xl p-5 mt-4">
        <h4 class="font-bold text-lg">
            Real-World Example
        </h4>

        <p class="sharedTXTMuted mt-3">
            A system may store users enrolled in different training courses.
            Combining the course sets produces the list of all users enrolled
            in at least one course. Intersecting the sets identifies users
            enrolled in every course being considered.
        </p>
    </div>

</div>
