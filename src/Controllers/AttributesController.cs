using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using PnP_Universal.Models;

namespace PnP_Universal.Controllers
{
    [Produces("application/json")]
    [Route("api/Attributes")]
    public class AttributesController : Controller
    {
        private readonly PnPContext _context;

        public AttributesController(PnPContext context)
        {
            _context = context;
        }

        // GET: api/Attributes
        [HttpGet]
        public IEnumerable<Attributes> GetAttributes()
        {
            return _context.Attributes;
        }

        // GET: api/Attributes/5
        [HttpGet("{id}")]
        public async Task<IActionResult> GetAttributes([FromRoute] int id)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            var attributes = await _context.Attributes.SingleOrDefaultAsync(m => m.Id == id);

            if (attributes == null)
            {
                return NotFound();
            }

            return Ok(attributes);
        }

        // PUT: api/Attributes/5
        [HttpPut("{id}")]
        public async Task<IActionResult> PutAttributes([FromRoute] int id, [FromBody] Attributes attributes)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != attributes.Id)
            {
                return BadRequest();
            }

            _context.Entry(attributes).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!AttributesExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return NoContent();
        }

        // POST: api/Attributes
        [HttpPost]
        public async Task<IActionResult> PostAttributes([FromBody] Attributes attributes)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            _context.Attributes.Add(attributes);
            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateException)
            {
                if (AttributesExists(attributes.Id))
                {
                    return new StatusCodeResult(StatusCodes.Status409Conflict);
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtAction("GetAttributes", new { id = attributes.Id }, attributes);
        }

        // DELETE: api/Attributes/5
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteAttributes([FromRoute] int id)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            var attributes = await _context.Attributes.SingleOrDefaultAsync(m => m.Id == id);
            if (attributes == null)
            {
                return NotFound();
            }

            _context.Attributes.Remove(attributes);
            await _context.SaveChangesAsync();

            return Ok(attributes);
        }

        private bool AttributesExists(int id)
        {
            return _context.Attributes.Any(e => e.Id == id);
        }
    }
}