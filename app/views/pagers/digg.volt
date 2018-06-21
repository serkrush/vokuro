{#/**#}
 {#* Digg pagination style#}
 {#* #}
 {#* @preview  « Previous  1 2 … 5 6 7 8 9 10 11 12 13 14 … 25 26  Next »#}
 {#*/#}

{% if pager.total_pages <= 1 %}
    <?php return; ?>
{% endif %}

{% set url = url is defined?url:false %}
{% set lenght = lenght is defined?lenght:10 %}

<div class="pagination">

    <ul>
        <li class="{{ pager.before != pager.current? "" : 'disabled' }}">
            {% if pager.before != pager.current %}
                <a href="{{ url?url~"?page="~pager.before:"#" }}" data-page="{{ pager.before }}">
                    Prev
                </a>
            {% else %}
                <span>Prev</span>
            {% endif %}
        </li>

        {# « Previous  1 2 3 4 5 6 7 8 9 10 11 12  Next »  #}
        {% if pager.total_pages < lenght + 3 %}

            {% for i in 1..pager.total_pages %}
                <li class="{{ i == pager.current? "active" : "" }}">
                    {% if i == pager.current %}
                        <span>{{ i }}</span>
                    {% else %}
                        <a href="{{ url?url~"?page="~i:"#" }}" data-page="{{ i }}">{{ i }}</a>
                    {% endif %}
                </li>
            {% endfor %}

        {% elseif pager.current < lenght - 1 %} {#« Previous  1 2 3 4 5 6 7 8 9 10 … 25 26  Next »#}
            {% for i in 1..lenght %}
                <li class="{{ i == pager.current ?  "active" : "" }}">
                    {% if i == pager.current %}
                        <span>{{ i }}</span>
                    {% else %}
                        <a href="{{ url?url~"?page="~i:"#" }}" data-page="{{ i }}">{{ i }}</a>
                    {% endif %}
                </li>
            {% endfor %}
            <li>
                <span>&hellip;</span>
            </li>
            <li>
                <a href="{{ url?url~"?page="~(pager.total_pages - 1):"#" }}" data-page="{{ pager.total_pages - 1 }}">
                    {{ pager.total_pages - 1 }}
                </a>
            </li>
            <li>
                <a href="{{ url?url~"?page="~(pager.total_pages):"#" }}" data-page="{{ pager.total_pages }}">
                    {{ pager.total_pages }}
                </a>
            </li>

        {% elseif pager.current > pager.total_pages - (lenght - 2) %} {# « Previous  1 2 … 17 18 19 20 21 22 23 24 25 26  Next » #}

            <li>
                <a href="{{ url?url~"?page=1":"#" }}" data-page="1">1</a>
            </li>
            <li>
                <a href="{{ url?url~"?page=2":"#" }}" data-page="2">2</a>
            </li>
            <li>
                <span>&hellip;</span>
            </li>
            {% for i in (pager.total_pages - (lenght - 1)) .. pager.total_pages %}
                <li class="{{ i == pager.current?"active" : "" }}">
                    {% if i == pager.current %}
                        <span>{{ i }}</span>
                    {% else %}
                        <a href="{{ url?url~"?page="~i:"#" }}" data-page="{{ i }}">{{ i }}</a>
                    {% endif %}
                </li>
            {% endfor %}

        {% else %} {# « Previous  1 2 … 5 6 7 8 9 10 11 12 13 14 … 25 26  Next » #}
            <li>
                <a href="{{ url?url~"?page=1":"#" }}" data-page="1">1</a>
            </li>
            <li>
                <a href="{{ url?url~"?page=2":"#" }}" data-page="2">2</a>
            </li>
            <li>
                <span>&hellip;</span>
            </li>
            {% for i in (pager.current - lenght / 2).. (pager.current + lenght / 2) %}
                <li class="{{ i == pager.current?"active" : "" }}">
                    {% if i == pager.current %}
                        <span>{{ i }}</span>
                    {% else %}
                        <a href="{{ url?url~"?page="~i:"#" }}" data-page="{{ i }}">{{ i }}</a>
                    {% endif %}
                </li>
            {% endfor %}
            <li>
                <span>&hellip;</span>
            </li>
            <li>
                <a href="{{ url?url~"?page="~(pager.total_pages - 1):"#" }}" data-page="{{ pager.total_pages - 1 }}">
                    {{ pager.total_pages - 1 }}
                </a>
            </li>
            <li>
                <a href="{{ url?url~"?page="~(pager.total_pages):"#" }}" data-page="{{ pager.total_pages }}">
                    {{ pager.total_pages }}
                </a>
            </li>

        {% endif %}

        <li class="{{ pager.next != pager.current? "" : "disabled" }}">
            {% if pager.next != pager.current%}
                <a href="{{ url?url~"?page="~pager.next:"#" }}" data-page="{{ pager.next }}">
                    Next
                </a>
            {% else %}
                <span>Next</span>
            {% endif %}

        </li>

    </ul>

</div>
